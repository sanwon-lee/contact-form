<?php

use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('renders the registration screen', function () {
    get('/register')->assertStatus(200);
});

it('allows new users to register', function () {
    $response = post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    assertAuthenticated();
    assertDatabaseHas('users', ['email' => 'test@example.com']);
    $response->assertRedirect('/admin');
});
