<?php

namespace Database\Seeders;

use App\Models\AiPromptTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AiPromptTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'name' => 'SEO Optimizasyonlu Blog Yazısı',
                'description' => 'SEO odaklı, kapsamlı ve detaylı blog yazıları için optimize edilmiş şablon. Arama motorlarında üst sıralarda yer almak için tasarlanmıştır.',
                'system_prompt' => 'You are an expert SEO content writer for {site_name}. Your task is to create highly optimized, engaging, and comprehensive blog articles in {language}. Write with a {tone} tone using a {writing_style} writing style. Ensure proper HTML formatting with semantic tags (<h2>, <h3>, <strong>, <em>, <p>, <ul>, <li>). Focus on readability, user engagement, and search engine optimization. Include relevant keywords naturally throughout the content.',
                'user_prompt_template' => 'Write a comprehensive, SEO-optimized article about: {topic}

The article should be approximately {word_count} words and follow these requirements:
- Target the main keyword naturally throughout the content
- Create compelling subheadings that include related keywords
- Write for both search engines and human readers
- Include actionable insights and practical advice
- Use a clear, logical structure with proper heading hierarchy',
                'language' => 'tr',
                'tone' => 'professional',
                'writing_style' => 'engaging',
                'default_word_count' => 1200,
                'include_introduction' => true,
                'include_conclusion' => true,
                'include_faq' => true,
                'faq_count' => 5,
                'include_bullet_points' => true,
                'include_statistics' => true,
                'include_examples' => true,
                'include_call_to_action' => true,
                'seo_optimized' => true,
                'include_keywords' => true,
                'heading_structure' => 'h2_h3',
                'paragraph_length' => 3,
                'preferred_model' => 'gpt-4-turbo',
                'temperature' => 0.7,
                'max_tokens' => 4000,
                'is_active' => true,
                'is_default' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Hızlı Blog Yazısı',
                'description' => 'Kısa sürede oluşturulacak, orta uzunlukta blog yazıları için uygun şablon.',
                'system_prompt' => 'You are a professional content writer for {site_name}. Create concise, engaging blog posts in {language} with a {tone} tone. Use a {writing_style} writing style. Format content with proper HTML tags. Focus on delivering value quickly and clearly.',
                'user_prompt_template' => 'Write an article about: {topic}

Target length: approximately {word_count} words
Focus on:
- Clear and concise explanations
- Practical, actionable advice
- Easy-to-scan format with bullet points
- Engaging introduction and strong conclusion',
                'language' => 'tr',
                'tone' => 'intimate',
                'writing_style' => 'simplified',
                'default_word_count' => 700,
                'include_introduction' => true,
                'include_conclusion' => true,
                'include_faq' => false,
                'include_bullet_points' => true,
                'include_statistics' => false,
                'include_examples' => true,
                'include_call_to_action' => true,
                'seo_optimized' => true,
                'include_keywords' => true,
                'heading_structure' => 'h2_h3',
                'paragraph_length' => 2,
                'preferred_model' => 'gpt-3.5-turbo-0125',
                'temperature' => 0.7,
                'max_tokens' => 3000,
                'is_active' => true,
                'is_default' => false,
                'sort_order' => 2,
            ],
            [
                'name' => 'Kapsamlı Rehber Yazısı',
                'description' => 'Detaylı, adım adım rehber niteliğinde uzun blog yazıları için ideal şablon.',
                'system_prompt' => 'You are an expert technical writer for {site_name}. Create comprehensive, tutorial-style guide articles in {language}. Write with a {tone} tone using a {writing_style} style. Ensure detailed explanations, step-by-step instructions, and practical examples. Use proper HTML formatting with multiple heading levels for complex topics.',
                'user_prompt_template' => 'Create a comprehensive guide about: {topic}

Target length: approximately {word_count} words

Structure requirements:
- Detailed introduction explaining what readers will learn
- Step-by-step breakdown of the process or concept
- Practical examples and use cases
- Troubleshooting tips or common mistakes to avoid
- Summary of key takeaways
- Resources for further learning',
                'language' => 'tr',
                'tone' => 'confident',
                'writing_style' => 'academic',
                'default_word_count' => 2000,
                'include_introduction' => true,
                'include_conclusion' => true,
                'include_faq' => true,
                'faq_count' => 8,
                'include_bullet_points' => true,
                'include_statistics' => true,
                'include_examples' => true,
                'include_call_to_action' => true,
                'seo_optimized' => true,
                'include_keywords' => true,
                'heading_structure' => 'h2_h3_h4',
                'paragraph_length' => 4,
                'preferred_model' => 'gpt-4-turbo',
                'temperature' => 0.6,
                'max_tokens' => 4000,
                'is_active' => true,
                'is_default' => false,
                'sort_order' => 3,
            ],
            [
                'name' => 'İngilizce Blog Yazısı (English)',
                'description' => 'Professional English blog posts with SEO optimization.',
                'system_prompt' => 'You are a professional English content writer for {site_name}. Create engaging, well-structured blog articles in English with a {tone} tone and {writing_style} writing style. Use proper HTML formatting and ensure content is optimized for both readers and search engines.',
                'user_prompt_template' => 'Write a professional blog article about: {topic}

Target word count: approximately {word_count} words

Requirements:
- Write in clear, professional English
- Use active voice and engaging language
- Include relevant examples and insights
- Optimize for SEO with natural keyword placement
- Create scannable content with subheadings and bullet points',
                'language' => 'en',
                'tone' => 'professional',
                'writing_style' => 'engaging',
                'default_word_count' => 1000,
                'include_introduction' => true,
                'include_conclusion' => true,
                'include_faq' => true,
                'faq_count' => 5,
                'include_bullet_points' => true,
                'include_statistics' => true,
                'include_examples' => true,
                'include_call_to_action' => true,
                'seo_optimized' => true,
                'include_keywords' => true,
                'heading_structure' => 'h2_h3',
                'paragraph_length' => 3,
                'preferred_model' => 'gpt-4-turbo',
                'temperature' => 0.7,
                'max_tokens' => 3500,
                'is_active' => true,
                'is_default' => false,
                'sort_order' => 4,
            ],
            [
                'name' => 'Ürün İnceleme Yazısı',
                'description' => 'Ürün veya hizmet incelemesi için optimize edilmiş şablon. Detaylı analiz ve karşılaştırma içerir.',
                'system_prompt' => 'You are a product review specialist for {site_name}. Write detailed, balanced product reviews in {language} with a {tone} tone. Use a {writing_style} approach. Include pros and cons, comparisons, and personal insights. Format with HTML tags for readability.',
                'user_prompt_template' => 'Write a detailed product/service review about: {topic}

Target length: approximately {word_count} words

Review structure:
- Overview and first impressions
- Key features and specifications
- Performance analysis
- Pros and cons
- Comparison with alternatives
- Value for money assessment
- Final verdict and recommendations',
                'language' => 'tr',
                'tone' => 'standard',
                'writing_style' => 'persuasive',
                'default_word_count' => 1500,
                'include_introduction' => true,
                'include_conclusion' => true,
                'include_faq' => true,
                'faq_count' => 6,
                'include_bullet_points' => true,
                'include_statistics' => true,
                'include_examples' => true,
                'include_call_to_action' => true,
                'seo_optimized' => true,
                'include_keywords' => true,
                'heading_structure' => 'h2_h3',
                'paragraph_length' => 3,
                'preferred_model' => 'gpt-4-turbo',
                'temperature' => 0.8,
                'max_tokens' => 4000,
                'is_active' => true,
                'is_default' => false,
                'sort_order' => 5,
            ],
        ];

        foreach ($templates as $template) {
            AiPromptTemplate::updateOrCreate(
                ['name' => $template['name']],
                $template
            );
        }
    }
}
