<?php

namespace Database\Factories;

use App\Enums\Gender;
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
            Contact::COL_CATEGORY_ID => Category::factory(),
            Contact::COL_FIRST_NAME  => mb_substr(fake()->firstName(), 0, 4),
            Contact::COL_LAST_NAME   => mb_substr(fake()->lastName(), 0, 4),
            Contact::COL_GENDER      => fake()->randomElement(Gender::cases()),
            Contact::COL_EMAIL       => fake()->safeEmail(),
            Contact::COL_TEL         => fake()->numerify('#####'),
            Contact::COL_ADDRESS     => fake()->prefecture() . fake()->streetAddress(),
            Contact::COL_BUILDING    => fake()->optional()->secondaryAddress(),
            Contact::COL_DETAIL      => fake()->realText(120),
            Contact::COL_CREATED_AT  => $createdAt,
            Contact::COL_UPDATED_AT  => $createdAt,
        ];
    }
}
