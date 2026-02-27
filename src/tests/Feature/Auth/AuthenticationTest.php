<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('redirects guests to the login page when accessing /admin', function () {
    get('/admin')->assertRedirect('/login');
});

it('allows authenticated users to access /admin', function () {
    $user = User::factory()->make();

    $response = actingAs($user)->get('/admin');

    $response->assertStatus(200);
});
