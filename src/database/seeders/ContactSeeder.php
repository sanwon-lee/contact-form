<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        Contact::factory(35)->recycle($categories)->create();
    }
}
