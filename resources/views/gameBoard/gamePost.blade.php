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

  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <body class="bg-gray-100">
          <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <!-- 게시물 목록 -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-6">
                  <!-- 각 게시물 -->
                  @if ($gamePosts->isEmpty())
                  <div class="bg-gray-200 p-4 rounded-lg">
                    <p class="text-center text-2xl font-semibold">게시물이 없습니다.</p>
                  </div>
                  @else
                  @foreach ($gamePosts as $gamePost)
                  <div class="bg-gray-200 p-4 rounded-lg">
                    <div class="flex justify-between">
                      <a class="flex-1 mr-4 truncate text-2xl font-semibold mb-2"
                        href="{{ route('gameBoard.show', ['gameBoard' => $gamePost->id]) }}">
                        {{$gamePost->title}}
                      </a>
                      {{-- 게시물 삭제 버튼 --}}
                      @if($gamePost->user_id === Auth::user()->id || Auth::user()->is_admin === 1)
                      <form action="{{ route('gameBoard.destroy', ['gameBoard' => $gamePost->id]) }}"
                        onsubmit="return confirm('정말로 삭제하시겠습니까?')" method="POST">
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
                      <div class="flex justify-between">
                        <p class="text-gray-700 mb-2">
                          작성자: {{$gamePost->user->user_id}}
                        </p>
                        <p class="text-gray-700 mb-2">
                          댓글 수: {{$gamePost->comments->count()}}
                        </p>
                      </div>

                      @if($gamePost->updated_at == $gamePost->created_at)
                      <p class="text-gray-700">
                        작성 일시: {{$gamePost->created_at}}
                      </p>
                      @else
                      <p class="text-gray-700">
                        수정 일시: {{$gamePost->updated_at}} (수정됨)
                      </p>
                      @endif
                    </a>
                  </div>
                  @endforeach
                </div>

                {{$gamePosts->links() }}
                @endif

              </div>


            </div>
          </div>
        </body>
      </div>
    </div>
  </div>
  </div>
</x-app-layout>

{{-- 세션에 저장된 알림 메시지가 있는지 확인하고 있다면 alert을 표시합니다. --}}
<script>
  @if(Session::has('alert'))
    alert('{{ Session::get('alert') }}');
  @endif
</script>