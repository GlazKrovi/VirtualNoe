<?php

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
        Schema::create('items', function (Blueprint $table) {
            // common to all items
            $table->id();
            $table->string('name')->unique();
            $table->string('type')->default('food');
            $table->integer('price')->default(10);
            $table->integer('modificator')->default(10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_user');
        Schema::dropIfExists('boost_user');
        Schema::dropIfExists('foods');
        Schema::dropIfExists('boosts');
        Schema::dropIfExists('items');
    }
};
