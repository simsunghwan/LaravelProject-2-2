<x-app-layout>
  <header>
    <style>
      .rating {
        unicode-bidi: bidi-override;
        direction: rtl;
      }

      .star {
        font-size: 1.5em;
        cursor: pointer;
        transition: color 0.5s;
        color: orange
      }
    </style>
  </header>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

        <h2 class="font-semibold text-2xl text-gray-800 flex items-center leading-tight">
          제목: {{ $gamePost->title }}
        </h2>
        <div class="flex justify-between my-2">
          <p class="text-gray-700 font-semibold">
            작성자: {{ $gamePost->user->user_id }}
          </p>

          @if($gamePost->updated_at == $gamePost->created_at)
          <p class="text-gray-700 font-semibold">
            작성 일시: {{$gamePost->created_at}}
          </p>
          @else
          <p class="text-gray-700  font-semibold">
            수정 일시: {{$gamePost->updated_at}} (수정됨)
          </p>
          @endif
        </div>
        <div class="flex justify-between items-center mb-4">
          <div class="w-1/2  flex items-center">
            <div class="block text-gray-700 text-xl font-bold whitespace-nowrap">
              게임 평점:
              @for ($i = 1; $i <= $gamePost->rating; $i++)
                <span class="star">&#9733;</span>
                @endfor
            </div>
          </div>
          <div class="w-1/4  flex items-center">
            <div class="block text-gray-700 text-xl font-bold  whitespace-nowrap">게임
              난이도: {{ $gamePost->difficulty }}
            </div>
          </div>
          <div class="w-1/4  flex items-center">
            <div class="block text-gray-700 text-xl font-bold whitespace-nowrap">게임
              카테고리: {{ $gamePost->categories->name }}
            </div>
          </div>
        </div>
        <hr />

        @if ($gamePost->img_path != null)
        <img alt="" src="{{ asset('storage/' . $gamePost->img_path) }}"
          class="w-auto h-auto object-cover max-h-72 max-w-72 rounded-lg mt-3 ">
        @endif

        <p class="block text-gray-700 text-xl font-bold mt-6">
          {{$gamePost->content}}
        </p>
        <div class="flex justify-between mt-3">
          <x-href-button class="mr-2" href="{{ route('gameBoard.index')}}">돌아가기</x-href-button>
          <div class="flex">
            @if($gamePost->user_id === Auth::user()->id || Auth::user()->is_admin === 1)
            <form id="deleteForm" action="{{ route('gameBoard.destroy', ['gameBoard' => $gamePost->id]) }}"
              method="POST">
              @csrf
              @method('DELETE')
              <x-danger-button class="mr-2" onclick="confirmDelete(event)">
                삭제
              </x-danger-button>
            </form>
            <x-href-button href="{{ route('gameBoard.edit', ['gameBoard' => $gamePost->id]) }}">수정</x-href-button>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('gameBoard.comment', ['gamePost' => $gamePost])
</x-app-layout>

{{-- 세션에 저장된 알림 메시지가 있는지 확인하고 있다면 alert을 표시합니다. --}}
<script>
  @if(Session::has('alert'))
    alert('{{ Session::get('alert') }}');
  @endif
</script>