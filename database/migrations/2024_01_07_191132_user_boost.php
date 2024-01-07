<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Boost;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('boost_user', function (Blueprint $table) {
            $table->foreignIdFor(Boost::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->primary(['boost_id', 'user_id']);

            $table->integer('quantity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boost_user');
    }
};


