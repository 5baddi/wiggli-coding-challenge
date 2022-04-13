<?php
    
namespace Tests\Feature;
    
use Illuminate\Http\Response;
use Tests\TestCase;
    
class ListUsersTest extends TestCase 
{    
    public function testListUsers()
    {
        $this->json('get', 'api/v1/users')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'result'    => [
                        'data'  => [
                            '*' => [
                                'id',
                                'first_name',
                                'last_name',
                                'email',
                                'updated_at',
                                'created_at',
                            ]
                        ]
                    ]
                ]
            );
    }  
}