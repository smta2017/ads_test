<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\AdTag;

class AdTagApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_ad_tag()
    {
        $adTag = AdTag::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/ad_tags', $adTag
        );

        $this->assertApiResponse($adTag);
    }

    /**
     * @test
     */
    public function test_read_ad_tag()
    {
        $adTag = AdTag::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/ad_tags/'.$adTag->id
        );

        $this->assertApiResponse($adTag->toArray());
    }

    /**
     * @test
     */
    public function test_update_ad_tag()
    {
        $adTag = AdTag::factory()->create();
        $editedAdTag = AdTag::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/ad_tags/'.$adTag->id,
            $editedAdTag
        );

        $this->assertApiResponse($editedAdTag);
    }

    /**
     * @test
     */
    public function test_delete_ad_tag()
    {
        $adTag = AdTag::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/ad_tags/'.$adTag->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/ad_tags/'.$adTag->id
        );

        $this->response->assertStatus(404);
    }
}
