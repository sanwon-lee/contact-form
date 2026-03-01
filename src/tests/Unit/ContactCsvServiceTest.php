<?php

use App\Enums\Gender;
use App\Models\Category;
use App\Models\Contact;
use App\Services\ContactCsvService;

test('CSV generated correctly with BOM', function () {
    $category = Category::factory()->create(['content' => '不具合']);
    Contact::factory()->create([
        'category_id' => $category->id,
        'last_name'   => '山田',
        'first_name'  => '太郎',
        'gender'      => Gender::MALE,
    ]);

    $service = new ContactCsvService();
    $contacts = Contact::with('category')->get();

    $response = $service->download($contacts);

    ob_start();
    $response->sendContent();
    $csvContent = ob_get_clean();

    expect($csvContent)->toStartWith("\xEF\xBB\xBF");

    expect($csvContent)->toContain('お問い合わせの種類')
        ->and($csvContent)->toContain('メールアドレス');

    expect($csvContent)->toContain('山田')
        ->and($csvContent)->toContain('太郎')
        ->and($csvContent)->toContain('男性')
        ->and($csvContent)->toContain('不具合');
});
