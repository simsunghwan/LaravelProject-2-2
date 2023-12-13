<section>
  <div class="pb-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div>
          <h1 class="text-3xl font-semibold mb-4">댓글</h1>
        </div>
        <!-- 댓글 목록 -->
        <div class="my-4">
          @forelse($gamePost->comments as $comment)
          <div class="bg-gray-200 p-4 rounded-lg my-2">
            <div class="flex justify-between mb-2">
              <p class="text-gray-700 font-semibold">작성자: {{ $comment->user->user_id }}</p>

              @if($comment->updated_at == $comment->created_at)
              <p class="text-gray-700 font-semibold">
                작성 일시: {{$comment->created_at}}
              </p>
              @else
              <p class="text-gray-700  font-semibold">
                수정 일시: {{$comment->updated_at}} (수정됨)
              </p>
              @endif
            </div>
            <div class="flex justify-between">
              <p class="text-gray-700 flex-1">{{ $comment->content }}</p>
              @if($comment->user_id === Auth::user()->id || Auth::user()->is_admin === 1)
              <form
                action="{{ route('gameBoard.comment.update', ['gameBoard' => $gamePost->id, 'comment' => $comment->id]) }}"
                onsubmit="return confirm('정말로 삭제하시겠습니까?')" method="POST">
                @csrf
                @method('DELETE')
                <x-danger-button>
                  삭제
                </x-danger-button>
              </form>
              <x-primary-button class="ml-2" x-data="" x-on:click.prevent="$dispatch('open-modal', 'comment-edit')">
                수정
              </x-primary-button>
              @endif
            </div>
          </div>
          @empty
          <div class=" bg-gray-200 p-4 rounded-lg my-2">
            <p class="text-gray-500 font-semibold">댓글이 없습니다.</p>
          </div>
          @endforelse
        </div>

        <!-- 댓글 입력 폼 -->
        <form action="{{ route('gameBoard.comment.store', ['gameBoard' => $gamePost->id]) }}" method="POST">
          @csrf
          <div class="mb-4 flex items-baseline">
            <textarea id="content" name="content" oninput="autoResize(this)" rows="1" class='border-gray-300 focus:border-indigo-500  focus:ring-indigo-500 rounded-md overflow-hidden shadow-sm w-full
              resize-none flex-1 mr-2' required></textarea>
            <x-primary-button>댓글 작성</x-primary-button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @if($gamePost->comments->count() > 0)
  <x-modal name="comment-edit" focusable>
    <form method="post"
      action="{{ route('gameBoard.comment.update', ['gameBoard' => $gamePost->id, 'comment' => $comment->id]) }}"
      class="p-6">
      @csrf
      @method('put')

      <h2 class="text-lg font-medium text-gray-900">
        댓글 수정
      </h2>
      <textarea id="content" name="content" oninput="autoResize(this)" rows="1" class='border-gray-300 focus:border-indigo-500  focus:ring-indigo-500 rounded-md overflow-hidden shadow-sm w-full
                      resize-none flex-1 mt-2' required>{{$comment->content}}</textarea>
      <div class="mt-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">
          {{ __('취소') }}
        </x-secondary-button>

        <x-primary-button class="ml-3">
          수정
        </x-primary-button>
      </div>
    </form>
  </x-modal>
  @endif
</section>
{{-- 텍스트 사이즈 자동 조정 --}}
<script>
  const autoResize = (textarea) => {
  textarea.style.height = '1px';
  textarea.style.height = textarea.scrollHeight + 'px';
  }
</script>