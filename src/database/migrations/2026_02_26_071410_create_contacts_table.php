<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained();
            $table->string('first_name');
            $table->string('last_name');
            $table->tinyInteger('gender')->check('gender IN (1, 2, 3)');
            $table->string('email');
            $table->string('tel', 5)->check('tel REGEXP "^[0-9]{1-5}$"');
            $table->string('address');
            $table->string('building')->nullable();
            $table->text('detail')->check('CHAR_LENGTH(detail) <= 120');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
