<?php

use App\Models\Category;
use App\Models\Contact;

it('can create a contact', function () {
    $contact = Contact::factory()->create([
        'gender' => 1,
        'detail' => 'this is an example contact',
    ]);

    expect($contact->gender->value)->toBe(1);
    expect($contact->detail)->toBe('this is an example contact');
});

it('belongs to a category', function () {
    $category = Category::factory()->create([
        'content' => 'test category',
    ]);
    $contact = Contact::factory()->create([
        'category_id' => $category->id,
    ]);

    expect($contact->category)->toBeInstanceOf(Category::class)
        ->and($contact->category->id)->toBe($category->id)
        ->and($contact->category->content)->toBe('test category');
});

it('returns the correct full name', function () {
    $contact = Contact::factory()->make([
        'first_name' => 'あいうえ',
        'last_name'  => 'おかきく',
    ]);

    expect($contact->full_name)->toBe('おかきく　あいうえ');
});
