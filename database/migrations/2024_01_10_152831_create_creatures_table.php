<?php

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
        Schema::create('creatures', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default("anonymous");
            $table->string('species')->default("unknow");
            $table->integer('life')->default(100);
            $table->integer('level')->default(0);
            $table->integer('hunger')->default(50);
            $table->integer('stamina')->default(50);
            $table->timestamps();

            $table->foreignIdFor(User::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creatures');
    }
};
