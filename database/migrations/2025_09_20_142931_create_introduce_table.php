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
        Schema::create('introduce', function (Blueprint $table) {
            $table->id();
            $table->string('section', 50);
            $table->json('title');
            $table->json('content');
            $table->json('meta_title')->nullable();
            $table->json('meta_content')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('introduce');
    }
};
