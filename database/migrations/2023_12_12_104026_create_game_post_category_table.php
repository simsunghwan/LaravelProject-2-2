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
    Schema::create('game_post_category', function (Blueprint $table) {
      $table->id();
      $table->foreignId('game_post_id')->constrained('game_posts')->onDelete('cascade')->onUpdate('cascade');
      $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->onUpdate('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('game_post_category');
  }
};
