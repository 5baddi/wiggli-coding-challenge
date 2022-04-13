<?php
    
namespace Tests\Controllers;
    
use Illuminate\Http\Response;
use Tests\TestCase;
    
class ListUsersControllerTest extends TestCase {
    
    public function testIndexReturnsDataInValidFormat() {
    
    $this->json('get', 'api/v1/users')
         ->assertStatus(Response::HTTP_OK)
         ->assertJsonStructure(
            [
                'data' => [
                '   *' => [
                        '_id',
                        'first_name',
                        'last_name',
                        'email',
                        'updated_at',
                        'created_at',
                    ]
                ]
            ]
         );
  }
    
}