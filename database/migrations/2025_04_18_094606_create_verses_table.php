<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('testament_id');
            $table->unsignedBigInteger('book_id');
            $table->string('version', 10);
            $table->integer('chapter');
            $table->integer('verse');
            $table->string('text', 1800);
            $table->timestamps();

            $table->foreign('testament_id')->references('id')->on('testaments');
            $table->foreign('book_id')->references('id')->on('books');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verses');
    }
};
