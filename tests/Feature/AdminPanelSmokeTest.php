<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_resource_pages_render(): void
    {
        $admin = User::factory()->create();
        $this->actingAs($admin);

        $paths = [
            'admin/categories', 'admin/categories/create',
            'admin/products', 'admin/products/create',
            'admin/slides', 'admin/slides/create',
            'admin/news', 'admin/news/create',
            'admin/pages', 'admin/pages/create',
            'admin/dealers', 'admin/dealers/create',
            'admin/testimonials', 'admin/testimonials/create',
            'admin/leads', 'admin/leads/create',
            'admin/subscribers', 'admin/subscribers/create',
            'admin/menu-items', 'admin/menu-items/create',
            'admin/faqs', 'admin/faqs/create',
            'admin/manage-general', 'admin/manage-seo', 'admin/manage-email', 'admin/manage-homepage',
        ];

        foreach ($paths as $path) {
            $res = $this->get('/'.$path);
            $this->assertContains($res->getStatusCode(), [200], "FAIL: {$path} → HTTP ".$res->getStatusCode());
        }
    }
}
