<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class GamePostSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    \App\Models\GamePost::factory(50)->create();
  }
}
