<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request, string $gameBoard)
  {
    $request->validate([
      'content' => 'required',
    ]);

    Comment::create([
      'content' => $request->input('content'), // 내용
      'user_id' => auth()->user()->id, // 현재 인증된 사용자의 ID
      'game_post_id' => $gameBoard, // 게시글 ID
    ]);

    return redirect()->route('gameBoard.show', ['gameBoard' => $gameBoard]);
  }


  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $gameBoard, string $comment)
  {
    $request->validate([
      'content' => 'required',
    ]);

    $findComment = Comment::findOrFail($comment);
    $findComment->content = $request->input('content');

    if ($findComment->isDirty()) {
      $findComment->save();
      // 변경사항이 있을 때의 추가적인 로직 수행
      Session::flash('alert', '수정이 완료되었습니다.');
    }
    return redirect()->route('gameBoard.show', ['gameBoard' => $gameBoard]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $gameBoard, string $comment)
  {
    //

    $findComment = Comment::findOrFail($comment);
    $findComment->delete();
    Session::flash('alert', '삭제가 완료되었습니다.');
    return redirect()->route('gameBoard.show', ['gameBoard' => $gameBoard]);
  }
}
