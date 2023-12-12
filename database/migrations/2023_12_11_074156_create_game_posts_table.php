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
    Schema::create('game_posts', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('content');
      $table->string('difficulty');
      $table->string('rating');
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
      $table->foreignId('categories_id')->constrained('categories')->onDelete('cascade')->onUpdate('cascade');
      $table->string('img_path')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('game_posts');
  }
};
