<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AiPromptTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'system_prompt',
        'user_prompt_template',
        'language',
        'tone',
        'writing_style',
        'default_word_count',
        'include_introduction',
        'include_conclusion',
        'include_faq',
        'faq_count',
        'include_bullet_points',
        'include_statistics',
        'include_examples',
        'include_call_to_action',
        'seo_optimized',
        'include_keywords',
        'target_keywords',
        'heading_structure',
        'paragraph_length',
        'preferred_model',
        'temperature',
        'max_tokens',
        'is_active',
        'is_default',
        'sort_order',
    ];

    protected $casts = [
        'include_introduction' => 'boolean',
        'include_conclusion' => 'boolean',
        'include_faq' => 'boolean',
        'include_bullet_points' => 'boolean',
        'include_statistics' => 'boolean',
        'include_examples' => 'boolean',
        'include_call_to_action' => 'boolean',
        'seo_optimized' => 'boolean',
        'include_keywords' => 'boolean',
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'temperature' => 'float',
    ];

    protected static function boot()
    {
        parent::boot();

        // When setting a template as default, unset other defaults
        static::saving(function ($template) {
            if ($template->is_default) {
                static::where('id', '!=', $template->id)
                    ->where('is_default', true)
                    ->update(['is_default' => false]);
            }
        });
    }

    /**
     * Scope to get only active templates
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get the default template
     */
    public function scopeDefault(Builder $query): Builder
    {
        return $query->where('is_default', true);
    }

    /**
     * Get the compiled system prompt with all settings
     */
    public function getCompiledSystemPrompt(string $siteName): string
    {
        $prompt = $this->system_prompt;

        // Replace placeholders
        $prompt = str_replace('{site_name}', $siteName, $prompt);
        $prompt = str_replace('{language}', $this->getLanguageName(), $prompt);
        $prompt = str_replace('{tone}', $this->tone, $prompt);
        $prompt = str_replace('{writing_style}', $this->writing_style, $prompt);

        return $prompt;
    }

    /**
     * Get the compiled user prompt
     */
    public function getCompiledUserPrompt(string $topic, int $wordCount): string
    {
        $prompt = $this->user_prompt_template;

        $prompt = str_replace('{topic}', $topic, $prompt);
        $prompt = str_replace('{word_count}', $wordCount, $prompt);

        // Add content structure instructions
        $instructions = [];

        if ($this->include_introduction) {
            $instructions[] = '- Start with an engaging introduction';
        }

        if ($this->include_faq && $this->faq_count) {
            $instructions[] = "- Include a FAQ section with {$this->faq_count} frequently asked questions";
        }

        if ($this->include_bullet_points) {
            $instructions[] = '- Use bullet points where appropriate for better readability';
        }

        if ($this->include_statistics) {
            $instructions[] = '- Include relevant statistics and data to support the content';
        }

        if ($this->include_examples) {
            $instructions[] = '- Provide practical examples to illustrate key points';
        }

        if ($this->include_conclusion) {
            $instructions[] = '- End with a strong conclusion summarizing key points';
        }

        if ($this->include_call_to_action) {
            $instructions[] = '- Include a clear call-to-action at the end';
        }

        if (!empty($instructions)) {
            $prompt .= "\n\nContent Structure:\n" . implode("\n", $instructions);
        }

        return $prompt;
    }

    /**
     * Get language name from code
     */
    private function getLanguageName(): string
    {
        $languages = [
            'tr' => 'Turkish',
            'en' => 'English',
            'de' => 'German',
            'fr' => 'French',
            'es' => 'Spanish',
        ];

        return $languages[$this->language] ?? 'Turkish';
    }
}
