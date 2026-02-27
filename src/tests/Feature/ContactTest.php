<?php

use App\Enums\Gender;
use App\Models\Category;
use App\Models\Contact;

use function Pest\Laravel\post;

it('can create a contact', function () {
    $contact = Contact::factory()->create([
        Contact::COL_GENDER => 1,
        Contact::COL_DETAIL => 'this is an example contact',
    ]);

    expect($contact->gender->value)->toBe(1);
    expect($contact->detail)->toBe('this is an example contact');
});

it('belongs to a category', function () {
    $category = Category::factory()->create([
        Category::COL_CONTENT => 'test category',
    ]);
    $contact = Contact::factory()->create([
        Contact::COL_CATEGORY_ID => $category->id,
    ]);

    expect($contact->category)->toBeInstanceOf(Category::class)
        ->and($contact->category->id)->toBe($category->id)
        ->and($contact->category->content)->toBe('test category');
});

it('returns the correct full name', function () {
    $contact = Contact::factory()->make([
        Contact::COL_FIRST_NAME => 'あいうえ',
        Contact::COL_LAST_NAME => 'おかきく',
    ]);

    expect($contact->full_name)->toBe('おかきく　あいうえ');
});

it('returns the correct gender text', function ($genderValue, $expectedText) {
    $contact = Contact::factory()->make([
        Contact::COL_GENDER => $genderValue,
    ]);

    expect($contact->gender->label())->toBe($expectedText);
})->with([
    [Gender::MALE,   '男性'],
    [Gender::FEMALE, '女性'],
    [Gender::OTHER,  'その他'],
]);

it('returns validation error when full name is longer than 8 characters', function () {
    Category::factory()->create();

    $response = post(route('contacts.confirm'), [
        Contact::COL_FIRST_NAME => '寿限無、寿限無、五劫のすりきれ',
        Contact::COL_LAST_NAME  => '杉田',
    ]);

    $response->assertStatus(302);
    $response->assertInvalid(['full_name',]);
});
