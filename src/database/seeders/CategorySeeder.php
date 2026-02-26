<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::upsert([
            [Category::COL_ID => 1, Category::COL_CONTENT => '商品のお届けについて'],
            [Category::COL_ID => 2, Category::COL_CONTENT => '商品の交換について'],
            [Category::COL_ID => 3, Category::COL_CONTENT => '商品トラブル'],
            [Category::COL_ID => 4, Category::COL_CONTENT => 'ショップへのお問い合わせ'],
            [Category::COL_ID => 5, Category::COL_CONTENT => 'その他'],
        ], [Category::COL_ID], [Category::COL_CONTENT]);
    }
}
