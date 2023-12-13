<?php

namespace Database\Factories;

use App\Models\GamePost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class CommentFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'content' => $this->faker->sentence(),
      'user_id' => User::inRandomOrder()->first()->id,
      'game_post_id' => GamePost::inRandomOrder()->first()->id
    ];
  }
}
