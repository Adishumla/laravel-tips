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
        Schema::create('resturants', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('user_id');
            $table->integer('price_id');
            $table->string('city');
            $table->string('name');
            $table->integer('description_id');
            $table->integer('likes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resturants');
    }
};
