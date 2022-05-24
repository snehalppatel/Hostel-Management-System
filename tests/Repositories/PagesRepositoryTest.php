<?php namespace Tests\Repositories;

use App\Models\Pages;
use App\Repositories\PagesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PagesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PagesRepository
     */
    protected $pagesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->pagesRepo = \App::make(PagesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_pages()
    {
        $pages = Pages::factory()->make()->toArray();

        $createdPages = $this->pagesRepo->create($pages);

        $createdPages = $createdPages->toArray();
        $this->assertArrayHasKey('id', $createdPages);
        $this->assertNotNull($createdPages['id'], 'Created Pages must have id specified');
        $this->assertNotNull(Pages::find($createdPages['id']), 'Pages with given id must be in DB');
        $this->assertModelData($pages, $createdPages);
    }

    /**
     * @test read
     */
    public function test_read_pages()
    {
        $pages = Pages::factory()->create();

        $dbPages = $this->pagesRepo->find($pages->id);

        $dbPages = $dbPages->toArray();
        $this->assertModelData($pages->toArray(), $dbPages);
    }

    /**
     * @test update
     */
    public function test_update_pages()
    {
        $pages = Pages::factory()->create();
        $fakePages = Pages::factory()->make()->toArray();

        $updatedPages = $this->pagesRepo->update($fakePages, $pages->id);

        $this->assertModelData($fakePages, $updatedPages->toArray());
        $dbPages = $this->pagesRepo->find($pages->id);
        $this->assertModelData($fakePages, $dbPages->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_pages()
    {
        $pages = Pages::factory()->create();

        $resp = $this->pagesRepo->delete($pages->id);

        $this->assertTrue($resp);
        $this->assertNull(Pages::find($pages->id), 'Pages should not exist in DB');
    }
}
