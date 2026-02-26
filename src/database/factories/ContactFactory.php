<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = fake()->dateTimeBetween('-1 month', 'now');

        return [
            Contact::COL_CATEGORY_ID => Category::inRandomOrder()->first()->id(),
            Contact::COL_FIRST_NAME  => fake()->firstName(),
            Contact::COL_LAST_NAME   => fake()->lastName(),
            Contact::COL_GENDER      => fake()->numberBetween(1, 3),
            Contact::COL_EMAIL       => fake()->email(),
            Contact::COL_TEL         => fake()->phoneNumber(),
            Contact::COL_ADDRESS     => fake()->address(),
            Contact::COL_BUILDING    => fake()->buildingNumber(),
            Contact::COL_DETAIL      => fake()->text(),
            Contact::COL_CREATED_AT  => $createdAt,
            Contact::COL_UPDATED_AT  => $createdAt,
        ];
    }
}
