<?php

use App\Models\User;

use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('renders the registration screen', function () {
    get('/register')->assertStatus(200);
});

it('allows new users to register', function () {
    $response = post('/register', [
        User::COL_NAME => 'Test User',
        User::COL_EMAIL => 'test@example.com',
        User::COL_PASSWORD => 'password123',
    ]);

    assertAuthenticated();
    assertDatabaseHas('users', [User::COL_EMAIL => 'test@example.com']);
    $response->assertRedirect('/admin');
});
