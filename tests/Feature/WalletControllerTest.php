<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WalletControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test user and assign it to the $user property
        $this->user = User::factory()->create();
    }

    public function test_can_create_wallet()
    {
        // Authenticate the user
        $this->actingAs($this->user, 'sanctum');

        $walletData = [
            'label'      => 'Test Wallet',
            'passphrase' => 'testpassphrase'
        ];

        // Send the POST request to create a wallet
        $response = $this->postJson('/api/wallets', $walletData);

        // Check the response
        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'bitgo_id',
                    'label',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

}
