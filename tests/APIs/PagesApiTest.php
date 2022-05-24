<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Pages;

class PagesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_pages()
    {
        $pages = Pages::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/pages', $pages
        );

        $this->assertApiResponse($pages);
    }

    /**
     * @test
     */
    public function test_read_pages()
    {
        $pages = Pages::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/pages/'.$pages->id
        );

        $this->assertApiResponse($pages->toArray());
    }

    /**
     * @test
     */
    public function test_update_pages()
    {
        $pages = Pages::factory()->create();
        $editedPages = Pages::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/pages/'.$pages->id,
            $editedPages
        );

        $this->assertApiResponse($editedPages);
    }

    /**
     * @test
     */
    public function test_delete_pages()
    {
        $pages = Pages::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/pages/'.$pages->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/pages/'.$pages->id
        );

        $this->response->assertStatus(404);
    }
}
