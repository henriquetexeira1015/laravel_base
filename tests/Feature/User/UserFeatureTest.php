<?php

namespace Tests\Feature\User;

use Illuminate\Console\View\Components\Choice;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserFeatureTest extends TestCase
{
    use REfreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_only_admin_users_can_see_all_users()
    {
        $normalUser = User::factory()
            ->create(['role' => fake()->randomElement(['producer', 'affiliate'])]);

        $adminUser = User::factory()
            ->create(['role' => 'admin']);

        $this->actingAs($normalUser, 'sanctum');

        $this->getJson(route('user-index'))
            ->assertForbidden()
            ->assertJsonFragment([
                'message' => "Only admin users can do this!"
            ]);

        $this->actingAs($adminUser, 'sanctum');

        $response = $this->getJson(route('user-index'))
            ->assertOk()
            ->assertJsonStructure([
                'message',
                'data' => [
                    'Users' => [
                        '*' => [
                            'id',
                            'name',
                            'email',
                            'role'
                        ]
                    ]
                ]
            ])
            ->json('data.Users');

        $response = collect($response)->pluck('email')->toArray();

        $this->assertContains($adminUser->email, $response);
        $this->assertContains($normalUser->email, $response);
    }

    public function test_user_can_create_account(): void
    {
        $data = [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => fake()->password(),
            'role' => fake()->randomElement(['admin', 'producer', 'affiliate']),
        ];

        $response = $this->postJson(route('user-store'), $data);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'message',
            'data' => [
                'User name',
                'User email',
                'User role',
            ]
        ]);

        $response->assertJsonFragment([
            'data' => [
                'User name' => $data['name'],
                'User email' => $data['email'],
                'User role' => $data['role']
            ],
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role']
        ]);
    }


    public function test_user_can_delete_his_own_account()
    {
        $user = User::factory()->create();

        $user2 = User::factory()->create();

        $this->actingAs($user, 'sanctum');

        $response = $this->deleteJson(route('user-destroy'));

        $this->assertDatabaseHas('users', [
            'name' => $user2->name,
            'email' => $user2->email,
        ]);

        $this->assertDatabaseMissing('users', [
            'name' => $user->name,
            'email' => $user->email
        ]);

    }
}