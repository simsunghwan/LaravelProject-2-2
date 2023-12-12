<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
      <!-- 댓글 목록 표시 -->
      <div id="comments">
        <!-- 여기에 댓글이 표시됩니다. -->
      </div>

      <!-- 댓글 입력 폼 -->
      <form action="handle_comment.php" method="post">
        <label for="username">사용자명:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="comment">댓글:</label><br>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea><br><br>
        <input type="submit" value="댓글 남기기">
      </form>
    </div>
  </div>
</div>