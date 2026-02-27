<?php

use App\Enums\Gender;
use App\Models\Category;
use App\Models\Contact;
use App\Services\ContactCsvService;

test('CSV generated correctly with BOM', function () {
    $category = Category::factory()->create([Category::COL_CONTENT => '不具合']);
    $contact = Contact::factory()->create([
        Contact::COL_CATEGORY_ID => $category->id,
        Contact::COL_LAST_NAME => '山田',
        Contact::COL_FIRST_NAME => '太郎',
        Contact::COL_GENDER => Gender::MALE,
    ]);

    $service = new ContactCsvService();
    $contacts = Contact::with('category')->get();

    $response = $service->download($contacts);

    ob_start();
    $response->sendContent();
    $csvContent = ob_get_clean();

    expect($csvContent)->toStartWith("\xEF\xBB\xBF");

    expect($csvContent)->toContain(Contact::getLabel(Contact::COL_CATEGORY_ID))
        ->and($csvContent)->toContain(Contact::getLabel(Contact::COL_EMAIL));

    expect($csvContent)->toContain('山田')
        ->and($csvContent)->toContain('太郎')
        ->and($csvContent)->toContain('男性')
        ->and($csvContent)->toContain('不具合');
});
