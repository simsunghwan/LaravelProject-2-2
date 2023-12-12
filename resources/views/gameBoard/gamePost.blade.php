<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        게임 리뷰 게시판
      </h2>
      <x-primary-button>
        <a href="{{ route('gameBoard.create') }}">게임 리뷰 작성하기</a>
      </x-primary-button>
    </div>
    <style>
      /* 스타일 */
      .star {
        font-size: 2em;
        cursor: pointer;
        transition: color 0.5s;
      }

      .star.rated {
        color: orange;
      }
    </style>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <body class="bg-gray-100">
          <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                  <!-- 게시물 목록 -->
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- 각 게시물 -->
                    @foreach ($gamePosts as $gamePost)
                    <div class="bg-gray-200 p-4 rounded-lg">
                      <div class="flex justify-between">
                        <a class="flex-1 mr-4 truncate text-2xl font-semibold mb-2"
                          href="{{ route('gameBoard.show', ['gameBoard' => $gamePost->id]) }}">
                          {{$gamePost->title}}
                        </a>
                        {{-- 게시물 삭제 버튼 --}}
                        @if($gamePost->user_id === Auth::user()->id)
                        <form action="{{ route('gameBoard.destroy', ['gameBoard' => $gamePost->id]) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <x-danger-button>
                            삭제
                          </x-danger-button>
                        </form>
                        @endif
                      </div>
                      {{-- 상세보기 링크 설정 --}}
                      <a href="{{ route('gameBoard.show', ['gameBoard' => $gamePost->id]) }}">
                        @if ($gamePost->img_path != null)
                        <img alt="" src={{'storage/' . $gamePost->img_path }} class="w-full h-40
                        object-cover
                        rounded-lg
                        mb-2">
                        @else
                        <img alt="" src="{{ asset('images/default_image.webp') }}"
                          class="w-full h-40 object-contain rounded-lg mb-2">
                        @endif
                        <p class="text-gray-700 mb-2">
                          작성자: {{$gamePost->user->user_id}}
                        </p>
                        @if($gamePost->updated_at == $gamePost->created_at)
                        <p class="text-gray-700">
                          작성 시간: {{$gamePost->created_at}}
                        </p>
                        @else
                        <p class="text-gray-700">
                          수정 시간: {{$gamePost->updated_at}} (수정됨)
                        </p>
                        @endif
                      </a>
                    </div>
                    @endforeach

                    <!-- 다른 게시물들을 추가할 수 있습니다 -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </body>
      </div>
    </div>
  </div>
  </div>
</x-app-layout>