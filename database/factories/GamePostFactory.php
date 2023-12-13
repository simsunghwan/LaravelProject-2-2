<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\GamePost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

class GamePostFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = GamePost::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {

    $imageDirectory = public_path('random_images');
    $images = File::allFiles($imageDirectory);
    $randomImage = $images[array_rand($images)];
    $randomImagePath = $randomImage->getPathname();


    File::copy($randomImagePath, public_path('storage/images/' . basename($randomImagePath)));


    return [
      'user_id' => User::inRandomOrder()->first()->id,
      'title' => $this->faker->sentence,
      'content' => $this->faker->paragraph,
      'img_path' => $this->faker->randomElement(['images/' . basename($randomImagePath), 'images/' . basename($randomImagePath), 'images/' . basename($randomImagePath), 'images/' . basename($randomImagePath), null]),
      'difficulty' => $this->faker->randomElement(['매우 쉬움', '쉬움', '보통', '어려움', '매우 어려움']),
      'rating' => $this->faker->numberBetween(1, 5),
      'categories_id' => Category::inRandomOrder()->first()->id
    ];
  }
}
