<?php
    
namespace Tests\Feature;
    
use Illuminate\Http\Response;
use Tests\TestCase;
    
class ListGroupsTest extends TestCase 
{
    public function testListGroups() 
    {
        $this->json('get', 'api/v1/groups')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'result'    => [
                        'data'  => [
                            '*' => [
                                'id',
                                'name',
                                'updated_at',
                                'created_at',
                            ]
                        ]
                    ]
                ]
            );
    } 
}