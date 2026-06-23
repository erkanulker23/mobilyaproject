<?php

namespace App\Services;

use App\Models\AiPromptTemplate;
use App\Settings\GeneralSettings;
use App\Settings\ThirdPartySettings;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use OpenAI;
use OpenAI\Client;
use OpenAI\Responses\Chat\CreateResponse;

class OpenAIService
{
    protected Client $client;

    protected string $model = 'gpt-4-turbo';

    public function __construct()
    {
        $thirdPartySettings = app(ThirdPartySettings::class);
        $this->client = OpenAI::client($thirdPartySettings->openai_api_key);
    }

    protected float $temperature = 0.7;

    protected int $maxTokens = 3000;

    public function createTurboJsonChat(array $messages, ?float $temperature = null, ?int $maxTokens = null): CreateResponse
    {
        return $this->client->chat()->create([
            'model' => $this->model,
            'messages' => $messages,
            'temperature' => $temperature ?? $this->temperature,
            'max_tokens' => $maxTokens ?? $this->maxTokens,
        ]);
    }

    public function setTemperature(float $temperature): void
    {
        $this->temperature = $temperature;
    }

    public function setMaxTokens(int $maxTokens): void
    {
        $this->maxTokens = $maxTokens;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function generatePostContent(string $topic, int $words, ?string $targetKeywords = null): ?string
    {
        $cacheKey = 'content_' . md5($topic . $words . ($targetKeywords ?? ''));

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $siteName = app(GeneralSettings::class)->site_name;
        $locale = app()->getLocale();

        $systemPrompt = 'You are a professional content writer tasked with creating detailed, engaging, and SEO-optimized articles. ' .
                       'The topic is: "' . $topic . '". Ensure the content is tailored to the company: "' . $siteName . '". ' .
                       'The article should be approximately ' . $words . ' words long. Write in a natural and fluent style, ' .
                       'avoiding excessive use of bullet points or numbered lists. Use bullet points or lists only when necessary ' .
                       'to enhance readability. Ensure the content is coherent, properly formatted in HTML (e.g., <h1>, <h2>, <h3>, <p>, <strong>), ' .
                       'and adheres to the specified word count as closely as possible. The language is: "' . $locale . '". ' .
                       'CRITICAL SEO OPTIMIZATION REQUIREMENTS: ' .
                       '1. Content MUST be at least 300 words (aim for ' . max($words, 300) . ' words). ' .
                       '2. Use proper heading hierarchy: Start with <h1> for main title, <h2> for main sections, <h3> for subsections. ' .
                       '3. Keep paragraphs well-structured with <p> tags. Each paragraph should be 3-5 sentences. ' .
                       '4. Keep average sentence length between 15-20 words for optimal readability. ' .
                       '5. Break content into at least 3-5 paragraphs. ' .
                       '6. Include at least 2-3 <h2> headings and 2-3 <h3> subheadings for better structure. ' .
                       '7. Write naturally and engagingly while maintaining SEO best practices.';

        if ($targetKeywords) {
            $systemPrompt .= ' CRITICAL KEYWORD OPTIMIZATION: Focus on these target keywords: "' . $targetKeywords . '". ' .
                           'Requirements: ' .
                           '1. Target keyword density should be 1-3% of total content. ' .
                           '2. Include the main keyword in the first <h1> or <h2> heading. ' .
                           '3. Use the keyword naturally in at least 2-3 headings (<h2> or <h3>). ' .
                           '4. Integrate keywords naturally throughout the content (introduction, body paragraphs, and conclusion). ' .
                           '5. Use variations and related terms of the main keyword to maintain natural flow. ' .
                           '6. Avoid keyword stuffing - keywords must appear naturally and contextually appropriate.';
        }

        $messages = [
            [
                'role' => 'system',
                'content' => $systemPrompt,
            ],
            [
                'role' => 'user',
                'content' => $topic,
            ],
        ];

        Log::info('Generating content for topic: ', ['Model' => $this->model, 'Topic' => $topic]);

        $response = $this->createTurboJsonChat($messages);

        if (isset($response->choices[0]->message->content)) {
            $content = $response->choices[0]->message->content;

            // Kelime sayısını kontrol ve kesme
            $wordCount = str_word_count(strip_tags($content));
            if ($wordCount > $words) {
                $content = implode(' ', array_slice(explode(' ', strip_tags($content)), 0, $words)) . '...';
            }

            // Firma adı kontrolü
            if (!str_contains($content, $siteName)) {
                $content .= "\n\n<b>About " . $siteName . ":</b> " . $siteName . " is a trusted name in the industry. Contact us for more information.";
            }

            Cache::put($cacheKey, $content, now()->addHours(24));

            Log::info('Content generated successfully for topic: ' . $topic);

            return $content;
        } else {
            Log::error('Content generation failed for topic: ' . $topic);
            return null;
        }
    }

    public function generateFields(string $topic, ?string $targetKeywords = null): array
    {
        $systemPrompt = 'Generate the following fields for a blog post about the topic: "' . $topic . '". ' .
                       'Fields include: title (creative and SEO-friendly), short_description (brief summary of the topic, max 200 characters), ' .
                       'seo_title (optimized for search engines, max 60 characters), seo_description (a meta description, max 160 characters), ' .
                       'focus_keyword (main keyword for SEO optimization), and slug (URL-friendly version of the title). ' .
                       'CRITICAL SEO REQUIREMENTS: ' .
                       '1. seo_title MUST be between 50-60 characters for optimal SEO (current best practice). ' .
                       '2. seo_description MUST be between 150-160 characters for optimal SEO. ' .
                       '3. seo_description MUST include a call-to-action phrase (e.g., "daha fazla", "devamı", "öğrenin", "keşfedin", "okuyun", "inceleyin"). ' .
                       '4. focus_keyword should be the main target keyword for this post. ' .
                       '5. seo_title and seo_description MUST contain the focus_keyword. ' .
                       '6. slug should be short, contain the focus_keyword, and be URL-friendly. ' .
                       'Ensure all fields are unique, relevant, and returned as a valid JSON-parsable PHP array.';

        if ($targetKeywords) {
            $systemPrompt .= ' IMPORTANT: Use "' . $targetKeywords . '" as the focus_keyword and incorporate it naturally in the title, SEO title, slug, and descriptions.';
        }

        $messages = [
            [
                'role' => 'system',
                'content' => $systemPrompt,
            ],
            [
                'role' => 'user',
                'content' => $topic,
            ],
        ];

        Log::info('Generating fields for topic: ' . $topic);

        $response = $this->createTurboJsonChat($messages);

        if (isset($response->choices[0]->message->content)) {
            $fields = json_decode($response->choices[0]->message->content, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                // Slug oluşturulması veya düzeltmesi
                if (!isset($fields['slug']) && isset($fields['title'])) {
                    $fields['slug'] = Str::slug($fields['title']);
                }

                // Eksik alanlar için varsayılan değerler
                $fields['title'] = $fields['title'] ?? $topic;
                $fields['short_description'] = $fields['short_description'] ?? substr($topic, 0, 200);
                $fields['seo_title'] = $fields['seo_title'] ?? substr($topic, 0, 60);
                $fields['seo_description'] = $fields['seo_description'] ?? substr($topic, 0, 160);
                $fields['focus_keyword'] = $fields['focus_keyword'] ?? ($targetKeywords ?: $topic);

                Log::info('Fields generated successfully: ', $fields);

                return $fields;
            } else {
                Log::error('Invalid JSON response for fields generation: ' . $response->choices[0]->message->content);
            }
        }

        return [];
    }

    /**
     * Generate post content using a prompt template
     */
    public function generatePostContentWithTemplate(string $topic, int $words, AiPromptTemplate $template, ?string $targetKeywords = null): ?string
    {
        $cacheKey = 'content_template_' . md5($topic . $words . $template->id . ($targetKeywords ?? ''));

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $siteName = app(GeneralSettings::class)->site_name;

        // Set model and parameters from template
        $this->setModel($template->preferred_model);
        $this->setTemperature($template->temperature);
        $this->setMaxTokens($template->max_tokens);

        $systemPrompt = $template->getCompiledSystemPrompt($siteName);
        $userPrompt = $template->getCompiledUserPrompt($topic, $words);

        // Add comprehensive SEO instructions
        $systemPrompt .= ' CRITICAL SEO OPTIMIZATION REQUIREMENTS: ' .
                        '1. Content MUST be at least 300 words. ' .
                        '2. Use proper heading hierarchy for better SEO. ' .
                        '3. Keep paragraphs well-structured with <p> tags. ' .
                        '4. Keep average sentence length between 15-20 words for optimal readability. ' .
                        '5. Break content into at least 3-5 paragraphs. ' .
                        '6. Write naturally and engagingly while maintaining SEO best practices.';

        // Add user-provided keywords first (higher priority)
        if ($targetKeywords) {
            $systemPrompt .= ' CRITICAL KEYWORD OPTIMIZATION: You MUST focus on these target keywords: "' . $targetKeywords . '". ' .
                           'Requirements: ' .
                           '1. Target keyword density should be 1-3% of total content. ' .
                           '2. Include the main keyword in the first heading. ' .
                           '3. Use the keyword naturally in at least 2-3 headings. ' .
                           '4. Integrate keywords naturally throughout the content (introduction, body paragraphs, and conclusion). ' .
                           '5. Use variations and related terms of the main keyword to maintain natural flow. ' .
                           '6. Avoid keyword stuffing - keywords must appear naturally and contextually appropriate.';
        }

        // Add SEO instructions if enabled
        if ($template->seo_optimized) {
            $systemPrompt .= ' Ensure the content is SEO-optimized with proper keyword placement and meta-friendly structure.';

            // Template keywords as additional suggestions (lower priority than user keywords)
            if ($template->include_keywords && $template->target_keywords && !$targetKeywords) {
                $systemPrompt .= ' Focus on these keywords: "' . $template->target_keywords . '". ' .
                               'Use them naturally with 1-3% keyword density in headings and throughout the content.';
            }
        }

        // Add heading structure instructions
        $headingInstructions = match ($template->heading_structure) {
            'h2_only' => 'Use only <h2> tags for main sections. Include at least 2-3 <h2> headings.',
            'h2_h3' => 'Use <h2> for main sections and <h3> for subsections. Include at least 2-3 <h2> headings and 2-3 <h3> subheadings.',
            'h2_h3_h4' => 'Use <h2> for main sections, <h3> for subsections, and <h4> for detailed points. Create a proper hierarchy with multiple headings at each level.',
            default => 'Use appropriate heading hierarchy with multiple heading levels.',
        };
        $systemPrompt .= ' ' . $headingInstructions;

        // Add paragraph instructions
        $systemPrompt .= " Keep paragraphs concise with approximately {$template->paragraph_length} sentences each.";

        $messages = [
            [
                'role' => 'system',
                'content' => $systemPrompt,
            ],
            [
                'role' => 'user',
                'content' => $userPrompt,
            ],
        ];

        Log::info('Generating content with template: ', [
            'Model' => $this->model,
            'Topic' => $topic,
            'Template' => $template->name,
            'Temperature' => $this->temperature,
        ]);

        $response = $this->createTurboJsonChat($messages);

        if (isset($response->choices[0]->message->content)) {
            $content = $response->choices[0]->message->content;

            // Word count validation
            $wordCount = str_word_count(strip_tags($content));
            if ($wordCount > $words * 1.2) { // Allow 20% overflow
                $words_array = explode(' ', strip_tags($content));
                $content = implode(' ', array_slice($words_array, 0, $words));
            }

            Cache::put($cacheKey, $content, now()->addHours(24));

            Log::info('Content generated successfully with template: ' . $template->name);

            return $content;
        } else {
            Log::error('Content generation failed for topic: ' . $topic);
            return null;
        }
    }

    /**
     * Generate fields using a prompt template
     */
    public function generateFieldsWithTemplate(string $topic, AiPromptTemplate $template, ?string $targetKeywords = null): array
    {
        $siteName = app(GeneralSettings::class)->site_name;

        // Set model and parameters from template
        $this->setModel($template->preferred_model);
        $this->setTemperature($template->temperature);
        $this->setMaxTokens($template->max_tokens);

        $languageName = match ($template->language) {
            'tr' => 'Turkish',
            'en' => 'English',
            'de' => 'German',
            'fr' => 'French',
            'es' => 'Spanish',
            default => 'Turkish',
        };

        $systemPrompt = "Generate the following fields for a blog post about the topic: \"{$topic}\" for {$siteName}. " .
                       "Fields include: title (creative and SEO-friendly), short_description (brief summary, max 200 characters), " .
                       "seo_title (optimized for search engines, max 60 characters), seo_description (meta description, max 160 characters), " .
                       "focus_keyword (main keyword for SEO optimization), and slug (URL-friendly). All content should be in {$languageName}. " .
                       "CRITICAL SEO REQUIREMENTS: " .
                       "1. seo_title MUST be between 50-60 characters for optimal SEO. " .
                       "2. seo_description MUST be between 150-160 characters for optimal SEO. " .
                       "3. seo_description MUST include a call-to-action phrase in {$languageName}. " .
                       "4. focus_keyword should be the main target keyword for this post. " .
                       "5. seo_title and seo_description MUST contain the focus_keyword. " .
                       "6. slug should be short, contain the focus_keyword, and be URL-friendly. " .
                       "Return as a valid JSON object with these exact keys.";

        // User-provided keywords have priority
        if ($targetKeywords) {
            $systemPrompt .= " IMPORTANT: Use \"{$targetKeywords}\" as the focus_keyword and incorporate it naturally in all fields: title, seo_title, slug, and descriptions.";
        } elseif ($template->seo_optimized && $template->target_keywords) {
            $systemPrompt .= " Use \"{$template->target_keywords}\" as the focus_keyword and incorporate it naturally in all fields.";
        }

        $messages = [
            [
                'role' => 'system',
                'content' => $systemPrompt,
            ],
            [
                'role' => 'user',
                'content' => $topic,
            ],
        ];

        Log::info('Generating fields with template: ' . $template->name);

        $response = $this->createTurboJsonChat($messages);

        if (isset($response->choices[0]->message->content)) {
            $fields = json_decode($response->choices[0]->message->content, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                // Ensure slug exists
                if (!isset($fields['slug']) && isset($fields['title'])) {
                    $fields['slug'] = Str::slug($fields['title']);
                }

                // Set defaults for missing fields
                $fields['title'] = $fields['title'] ?? $topic;
                $fields['short_description'] = $fields['short_description'] ?? substr($topic, 0, 200);
                $fields['seo_title'] = $fields['seo_title'] ?? substr($topic, 0, 60);
                $fields['seo_description'] = $fields['seo_description'] ?? substr($topic, 0, 160);
                $fields['focus_keyword'] = $fields['focus_keyword'] ?? ($targetKeywords ?: ($template->target_keywords ?: $topic));

                Log::info('Fields generated successfully with template: ', $fields);

                return $fields;
            } else {
                Log::error('Invalid JSON response for fields generation: ' . $response->choices[0]->message->content);
            }
        }

        return [];
    }
}
