<?php

namespace App\Jobs;

use App\Models\AiPromptTemplate;
use App\Models\User;
use App\Notifications\AiBlogPostCreatedNotification;
use App\Notifications\AiBlogPostFailedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CreateAIPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $topic,
        public array $extraFields,
        public int $words,
        public ?Model $post,
        public $modelClass,
        public User $user,
        public string $gptModel = 'gpt-3.5-turbo-0125',
        public ?int $templateId = null,
        public ?string $targetKeywords = null,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $openAIService = app(\App\Services\OpenAIService::class);
            $this->post = $this->post ?? new $this->modelClass();

            // Check if we should use a template
            if ($this->templateId) {
                $template = AiPromptTemplate::find($this->templateId);

                if ($template) {
                    $this->handleWithTemplate($openAIService, $template);
                    return;
                }
            }

            // Fallback to original method if no template
            $this->handleWithoutTemplate($openAIService);
        } catch (\Exception $e) {
            $this->handleFailure($e);
            throw $e;
        }
    }

    /**
     * Handle job failure and notify user
     */
    protected function handleFailure(\Exception $exception): void
    {
        Log::error('AI Post Generation Failed', [
            'topic' => $this->topic,
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);

        // Determine error type
        $errorType = 'unknown';
        $errorMessage = $exception->getMessage();

        if (str_contains($errorMessage, 'exceeded your current quota')) {
            $errorType = 'quota_exceeded';
            $errorMessage = 'OpenAI API kotanız dolmuş. Lütfen hesabınıza kredi yükleyin veya planınızı yükseltin.';
        } elseif (str_contains($errorMessage, 'Invalid API key') || str_contains($errorMessage, 'Incorrect API key')) {
            $errorType = 'invalid_key';
            $errorMessage = 'OpenAI API anahtarınız geçersiz. Lütfen API ayarlarınızı kontrol edin.';
        } elseif (str_contains($errorMessage, 'Rate limit')) {
            $errorType = 'api_error';
            $errorMessage = 'OpenAI API rate limit aşıldı. Lütfen birkaç dakika sonra tekrar deneyin.';
        } elseif (str_contains($errorMessage, 'API')) {
            $errorType = 'api_error';
            $errorMessage = 'OpenAI API hatası: ' . $errorMessage;
        }

        // Notify user
        $this->user->notify(new AiBlogPostFailedNotification(
            $this->topic,
            $errorMessage,
            $errorType
        ));
    }

    /**
     * Handle post generation with a prompt template
     */
    protected function handleWithTemplate(\App\Services\OpenAIService $openAIService, AiPromptTemplate $template): void
    {
        $key = 'openai-content-template-' . Str::slug($this->topic) . $this->words . $template->id;

        // Add keywords to cache key if provided
        if ($this->targetKeywords) {
            $key .= '-' . Str::slug($this->targetKeywords);
        }

        $fields = Cache::remember(
            $key . '-fields',
            now()->addMinutes(5),
            fn () => $openAIService->generateFieldsWithTemplate(
                $this->topic,
                $template,
                $this->targetKeywords,
            ),
        );

        $this->post->fill($fields);

        $this->post->content = Cache::remember(
            $key . '-content',
            now()->addMinutes(5),
            fn () => $openAIService->generatePostContentWithTemplate(
                $this->topic,
                $this->words,
                $template,
                $this->targetKeywords,
            ),
        );

        $this->post->save();

        $this->user->notify(new AiBlogPostCreatedNotification($this->post));
    }

    /**
     * Handle post generation without template (legacy method)
     */
    protected function handleWithoutTemplate(\App\Services\OpenAIService $openAIService): void
    {
        $openAIService->setModel($this->gptModel);
        $key = 'openai-content-' . Str::slug($this->topic) . $this->words . $this->gptModel;

        // Add keywords to cache key if provided
        if ($this->targetKeywords) {
            $key .= '-' . Str::slug($this->targetKeywords);
        }

        $fields = Cache::remember(
            $key . '-fields',
            now()->addMinutes(5),
            fn () => $openAIService->generateFields(
                $this->topic,
                $this->targetKeywords,
            ),
        );

        $this->post->fill($fields);

        $this->post->content = Cache::remember(
            $key . '-content',
            now()->addMinutes(5),
            fn () => $openAIService->generatePostContent(
                $this->topic,
                $this->words,
                $this->targetKeywords,
            ),
        );

        $this->post->save();

        $this->user->notify(new AiBlogPostCreatedNotification($this->post));
    }
}
