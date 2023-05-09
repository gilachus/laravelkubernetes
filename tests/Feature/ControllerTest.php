<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_a_user_via_user_controller(): void
    {
        // Check if there are any users in the database.
        $this->assertDatabaseCount(User::class, 0);

        // Prepare a data for request.
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@twirelab.com',
            'password' => 'Th!s1sVeryGoodP@ass#!',
        ];

        // Make a response.
        $response = $this->post('/api/users', $data);

        // Check if the response is successful.
        $response->assertSuccessful();

        // Check if there is user in the database.
        $this->assertDatabaseCount(User::class, 1);

        // Check the structure of the response.
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
            ],
        ]);

        // Check the fragment of the reponse.
        $response->assertJsonFragment([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }
}