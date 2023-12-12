<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamePost extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'content',
    'user_id',
    'categories_id',
    'img_path',
    'rating',
    'difficulty',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function categories()
  {
    return $this->belongsTo(Category::class);
  }
}
