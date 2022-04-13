<?php
    
namespace Tests\Controllers;
    
use Illuminate\Http\Response;
use Tests\TestCase;
    
class ListGroupsControllerTest extends TestCase {
    
    public function testIndexReturnsDataInValidFormat() {
    
    $this->json('get', 'api/v1/users')
         ->assertStatus(Response::HTTP_OK)
         ->assertJsonStructure(
            [
                'data' => [
                '   *' => [
                        '_id',
                        'name',
                        'updated_at',
                        'created_at',
                    ]
                ]
            ]
         );
  }
    
}