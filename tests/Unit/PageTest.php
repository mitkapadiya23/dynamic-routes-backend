<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_and_retrieve_nested_page()
    {
        $page1 = Page::create(['parent_id' => null, 'slug' => 'page1', 'title' => 'Page 1', 'content' => 'Content']);
        $page2 = Page::create(['parent_id' => $page1->id, 'slug' => 'page2', 'title' => 'Page 2', 'content' => 'Content']);
        $childPage = Page::create(['parent_id' => $page2->id, 'slug' => 'page1', 'title' => 'Page 1 Child', 'content' => 'Content']);

        // Simulate a request to the dynamic route: /page1/page2/page1
        $response = $this->get('/api/page1/page2/page1');
        $response->assertStatus(200)
                 ->assertJson([
                    'id' => $childPage->id,
                    'slug' => 'page1',
                    'title' => 'Page 1 Child'
                 ]);
    }
}
