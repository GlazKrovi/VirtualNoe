<?php

use App\Models\Item;
use App\Models\User;
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
        Schema::create('item_user', function (Blueprint $table) {
            $table->foreignIdFor(Item::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->primary(['item_id', 'user_id']);
            $table->integer('quantity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_user');
        Schema::dropIfExists('food_user');
        Schema::dropIfExists('boost_user');
        Schema::dropIfExists('foods');
        Schema::dropIfExists('boosts');
        Schema::dropIfExists('items');
    }
};
