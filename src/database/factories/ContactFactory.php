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
        return [
            'category_id' => Category::factory(),
            'first_name'  => mb_substr(fake()->firstName(), 0, intdiv(Contact::MAX_FULL_NAME_LENGTH, 2)),
            'last_name'   => mb_substr(fake()->lastName(), 0, intdiv(Contact::MAX_FULL_NAME_LENGTH, 2)),
            'gender'      => fake()->randomElement(Gender::cases()),
            'email'       => fake()->safeEmail(),
            'tel'         => fake()->phoneNumber(),
            'address'     => fake()->prefecture() . fake()->streetAddress(),
            'building'    => fake()->optional()->secondaryAddress(),
            'detail'      => fake()->realText(120),
        ];
    }
}
