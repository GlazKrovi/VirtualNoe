<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Food;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('food_user', function (Blueprint $table) {
            $table->foreignIdFor(Food::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->primary(['food_id', 'user_id']);

            $table->integer('quantity')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_user');
    }
};
