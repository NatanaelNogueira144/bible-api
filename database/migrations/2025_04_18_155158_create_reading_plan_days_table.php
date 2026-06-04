<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reading_plan_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reading_plan_id');
            $table->integer('day');
            $table->unsignedBigInteger('book_id');
            $table->integer('chapter');
            $table->integer('first_verse')->nullable();
            $table->integer('last_verse')->nullable();
            $table->timestamps();

            $table->foreign('reading_plan_id')->references('id')->on('reading_plans');
            $table->foreign('book_id')->references('id')->on('books');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reading_plan_days');
    }
};
