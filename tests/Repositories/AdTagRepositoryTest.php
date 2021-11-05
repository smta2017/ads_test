<?php namespace Tests\Repositories;

use App\Models\AdTag;
use App\Repositories\AdTagRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AdTagRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AdTagRepository
     */
    protected $adTagRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->adTagRepo = \App::make(AdTagRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_ad_tag()
    {
        $adTag = AdTag::factory()->make()->toArray();

        $createdAdTag = $this->adTagRepo->create($adTag);

        $createdAdTag = $createdAdTag->toArray();
        $this->assertArrayHasKey('id', $createdAdTag);
        $this->assertNotNull($createdAdTag['id'], 'Created AdTag must have id specified');
        $this->assertNotNull(AdTag::find($createdAdTag['id']), 'AdTag with given id must be in DB');
        $this->assertModelData($adTag, $createdAdTag);
    }

    /**
     * @test read
     */
    public function test_read_ad_tag()
    {
        $adTag = AdTag::factory()->create();

        $dbAdTag = $this->adTagRepo->find($adTag->id);

        $dbAdTag = $dbAdTag->toArray();
        $this->assertModelData($adTag->toArray(), $dbAdTag);
    }

    /**
     * @test update
     */
    public function test_update_ad_tag()
    {
        $adTag = AdTag::factory()->create();
        $fakeAdTag = AdTag::factory()->make()->toArray();

        $updatedAdTag = $this->adTagRepo->update($fakeAdTag, $adTag->id);

        $this->assertModelData($fakeAdTag, $updatedAdTag->toArray());
        $dbAdTag = $this->adTagRepo->find($adTag->id);
        $this->assertModelData($fakeAdTag, $dbAdTag->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_ad_tag()
    {
        $adTag = AdTag::factory()->create();

        $resp = $this->adTagRepo->delete($adTag->id);

        $this->assertTrue($resp);
        $this->assertNull(AdTag::find($adTag->id), 'AdTag should not exist in DB');
    }
}
