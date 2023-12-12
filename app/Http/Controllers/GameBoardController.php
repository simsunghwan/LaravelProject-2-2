<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GamePost;
use App\Models\Category;
use Illuminate\Http\Request;

class GameBoardController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // 
    $gamePosts = GamePost::all();
    $count = $gamePosts->count();
    return view('gameBoard.gamePost', ['gamePosts' => $gamePosts, 'count' => $count]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
    $categories = Category::all();


    return view('gameBoard.createGamePost', ['categories' => $categories]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
    $imagePath = null;
    if ($request->hasFile('game_image')) {
      $imagePath = $request->file('game_image')->store('images', 'public');
    }
    // 모델을 생성하기 위해 요청에서 받은 데이터에 추가적인 필드를 추가하여 저장
    GamePost::create([
      'title' => $request->input('game_title'),             // 제목
      'content' => $request->input('review_content'),       // 내용
      'img_path' => $imagePath,                             // 이미지 경로
      'user_id' => auth()->user()->id,                      // 현재 인증된 사용자의 ID
      'categories_id' => $request->input('category'),       // 카테고리 항목
      'rating' => $request->input('selectedRating'),        // 평점
      'difficulty' => $request->input('difficulty'),        // 난이도
    ]);

    return redirect()->route('gameBoard.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
    $gamePost = GamePost::findOrFail($id);

    return view('gameBoard.showGamePost', ['gamePost' => $gamePost]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
    $gamePost = GamePost::findOrFail($id);
    $categories = Category::all();

    return view('gameBoard.editGamePost', ['gamePost' => $gamePost, 'categories' => $categories]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
    $post = GamePost::findOrFail($id);

    // 변경된 데이터를 요청에서 가져옴

    $post->title = $request->input('game_title');            // 제목
    $post->content = $request->input('review_content');       // 내용
    $post->user_id = auth()->user()->id;                      // 현재 인증된 사용자의 ID
    $post->categories_id = $request->input('category');       // 카테고리 항목
    $post->rating = $request->input('selectedRating');        // 평점
    $post->difficulty = $request->input('difficulty');


    $imagePath = null;
    if ($request->hasFile('game_image')) {
      $imagePath = $request->file('game_image')->store('images', 'public');
      $post->img_path = $imagePath;
    }


    // 변경사항이 있는 경우에만 저장
    if ($post->isDirty()) {
      $post->save();
      // 변경사항이 있을 때의 추가적인 로직 수행
    }
    return redirect()->route('gameBoard.show', $id);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
    $gamePost = GamePost::findOrFail($id);

    // 이미지 파일 삭제
    if ($gamePost->img_path) {
      $imagePath = storage_path('app/public/' . $gamePost->img_path);
      if (file_exists($imagePath)) {
        unlink($imagePath);
      }
    }

    // 게시물 삭제
    $gamePost->delete();

    return redirect()->route('gameBoard.index');
  }
}
