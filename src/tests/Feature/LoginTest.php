<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('renders the login screen', function () {
    get('/login')->assertStatus(200);
});

it('can authenticate users using the login screen', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password123'),
    ]);

    $response = post('/login', [
        'email' => $user->email,
        'password' => 'password123',
    ]);

    assertAuthenticatedAs($user);
    $response->assertRedirect('/home');
});
