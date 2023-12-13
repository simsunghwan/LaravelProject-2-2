<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      게임 리뷰 수정하기
    </h2>
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
        <form id="gameForm" action="{{ route('gameBoard.update', ['gameBoard' => $gamePost->id]) }}"
          enctype="multipart/form-data" method="POST" class="p-6 space-y-6 ">
          @csrf
          @method('PUT')
          <div class="flex justify-between items-center mb-4">
            <div class="w-1/2 pr-4 flex items-center">
              <label for="category" class="block text-gray-700 text-xl font-bold mr-2 whitespace-nowrap">게임
                카테고리</label>
              <select id="category" name="category"
                class='border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md overflow-hidden shadow-sm w-full'>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $gamePost->categories_id === $category->id ? 'selected' : ''}}
                  >{{
                  $category->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="w-1/2 pr-4 flex items-center">
              <label for="difficulty" class="block text-gray-700 text-xl font-bold mr-2 whitespace-nowrap">게임
                난이도</label>
              <select id="difficulty" name="difficulty"
                class='border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md overflow-hidden shadow-sm w-full'>
                <option value="매우 쉬움" {{ $gamePost->difficulty === '매우 쉬움' ? 'selected' : '' }}>매우 쉬움</option>
                <option value="쉬움" {{ $gamePost->difficulty === '쉬움' ? 'selected' : '' }}>쉬움</option>
                <option value="보통" {{ $gamePost->difficulty === '보통' ? 'selected' : '' }}>보통</option>
                <option value="어려움" {{ $gamePost->difficulty === '어려움' ? 'selected' : '' }}>어려움</option>
                <option value="매우 어려움" {{ $gamePost->difficulty === '매우 어려움' ? 'selected' : '' }}>매우 어려움</option>
              </select>
            </div>
          </div>
          <div>
            <label for="game_title" class='block font-bold text-xl text-gray-700'>제목</label>
            <input id="game_title" name="game_title" type="text" cols="20" maxlength="20" rows="1"
              value="{{ $gamePost->title }}"
              class='border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md overflow-hidden shadow-sm w-full resize-none'
              required autofocus autocomplete="off">
            <p id="gameTitleError" class='text-sm hidden text-red-600 space-y-1'>글자수는 20자를 넘을 수
              없습니다.</p>
          </div>

          <div class="mb-4">
            <label for="review_content" class="block text-gray-700 text-xl font-bold mb-2 ">리뷰 내용</label>
            <textarea id="review_content" name="review_content" oninput="autoResize(this)" rows="1"
              class='border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md overflow-hidden shadow-sm w-full resize-none'
              required>{{ $gamePost->content }}</textarea>
          </div>

          <div class="mb-4">
            <label for="game_image" class="block text-gray-700 text-xl font-bold mb-2">게임 이미지 업로드</label>
            <div id="dropArea"
              class="flex items-center justify-center w-full h-48 border-dashed border-2 border-gray-300 rounded-md cursor-pointer">
              <label for="game_image"
                class="text-gray-500 hover:text-gray-700 transition duration-300 ease-in-out flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                  </path>
                </svg>
                <span class="ml-2">이미지를 선택하세요</span>
              </label>
              <input id="game_image" name="game_image" type="file" accept="image/*" class="hidden">
            </div>
            <p class="text-sm text-gray-500 mt-2">PNG, JPG, GIF 이미지 파일만 허용됩니다.</p>
            <img id="preview" src="#" alt="게임 이미지 미리보기"
              class="hidden w-auto h-auto max-h-72 max-w-72 object-cover rounded-md mt-4">
          </div>

          <div class="flex items-baseline">
            <div class="rating-value text-gray-700 text-xl font-bold ">평점: {{$gamePost->rating}}/5</div>
            <input type="hidden" id="selectedRating" name="selectedRating" value="{{ $gamePost->rating }}">
            <div class="star-rating flex ml-2">
              @for ($i = 1; $i <= 5; $i++) @if ($i <=$gamePost->rating)
                <span class="star rated" data-rating="{{ $i }}" value="{{ $i }}">&#9733;</span>
                @else
                <span class="star" data-rating="{{ $i }}" value="{{ $i }}">&#9733;</span>
                @endif
                @endfor
            </div>
          </div>
          <div class="flex justify-end">
            <x-href-button class="mr-2" href="{{ route('gameBoard.index')}}">취소</x-href-button>
            <x-primary-button>수정 완료</x-primary-button>
          </div>
        </form>

      </div>
    </div>
  </div>
</x-app-layout>

{{-- 텍스트 사이즈 자동 조정 --}}
<script>
  const autoResize = (textarea) => {
  textarea.style.height = '1px';
  textarea.style.height = textarea.scrollHeight + 'px';
  }
</script>
{{-- 게임 제목 에러 --}}
<script>
  const gameTitleInput = document.getElementById('game_title');
    const gameTitleError = document.getElementById('gameTitleError');

    gameTitleInput.addEventListener('input', function() {
        const gameTitleValue = this.value;

        if (gameTitleValue.length > 20) {
            gameTitleError.classList.remove('hidden');
        } else {
            gameTitleError.classList.add('hidden');
        }
    });
</script>
{{-- 평점 설정 --}}
<script>
  const stars = document.querySelectorAll('.star');
  const ratingValue = document.querySelector('.rating-value');
  const selectedRatingField = document.getElementById('selectedRating');

  document.getElementById('gameForm').addEventListener('submit', (e) => {
    const selectedRating = document.getElementById('selectedRating').value;
    if (selectedRating === "0") {
      e.preventDefault(); // 폼 제출 막기
      alert('평점을 선택해주세요.');
    } 
  });

  stars.forEach(star => {
    star.addEventListener('click', setRating);
  });

  function setRating(ev) {
    const clickedStar = ev.currentTarget;
    const rating = clickedStar.dataset.rating;

    ratingValue.textContent = `평점: ${rating}/5`;
    selectedRatingField.value = rating;

    stars.forEach(star => {
    if (star.dataset.rating <= rating) { 
        star.classList.add('rated'); 
      } else { 
        star.classList.remove('rated'); 
      } 
    }); 
  }
</script>

{{-- 파일 이미지 미리보기, drag&drop --}}
<script>
  const dropArea = document.getElementById('dropArea');
  const gameImageInput = document.getElementById('game_image');
  const previewImage = document.getElementById('preview');

  // drag&drop 기능 구현
  ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);
  });
  // 파일 사이즈 제한
 

  function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
  }

  ['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false);
  });

  ['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false);
  });

  function highlight() {
    dropArea.classList.add('border-indigo-500');
  }

  function unhighlight() {
    dropArea.classList.remove('border-indigo-500');
  }

  dropArea.addEventListener('drop', handleDrop, false);

  function handleDrop(e) {
  const files = e.dataTransfer.files;
    if (files.length > 0) {
      gameImageInput.files = files;
      if (checkSize()) {
        // 파일 크기 초과 시, 파일이 업로드되지 않았으므로 미리보기 초기화
        previewImage.classList.add('hidden');
        previewImage.src = '#';
      } else {
        gameImageInput.files = files;
        previewFile(files[0]);
      }
    }
  }

  function checkSize() {
    const file = gameImageInput.files[0];
    const fileSize = file ? file.size : 0; // 파일 크기 (단위: bytes)
    const maxSize = 4 * 1024 * 1024; // 4MB
    if (fileSize > maxSize) {
      alert('파일 크기가 4MB를 초과합니다. 더 작은 파일을 업로드해주세요.');
      this.value = ''; // 파일 선택 초기화
      previewImage.classList.add('hidden');
      previewImage.src = '#';
      return true; // 파일 크기 초과 시 함수 종료
    }
  }

  gameImageInput.addEventListener('change', function () {
    const file = this.files[0];

    if (file) {
      // 파일 선택 시
      if(checkSize())
        return 
      
      // 파일 크기 제한을 초과하지 않은 경우 파일 미리보기 실행
      const reader = new FileReader();
      reader.onload = function (e) {
          previewImage.src = e.target.result;
          previewImage.classList.remove('hidden');
      };
      reader.readAsDataURL(file);
    } else {
      // 파일 선택 취소 시, 미리보기 이미지 숨기기
      previewImage.classList.add('hidden');
      previewImage.src = '#';
    }
  });

  function previewFile(file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      previewImage.src = e.target.result;
      previewImage.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
  }



</script>

<script>
  const loadResize = (contentInput) => {
    contentInput.style.height = "0px";
    
    let scrollHeight = contentInput.scrollHeight;
    let style = window.getComputedStyle(contentInput);
    let borderTop = parseInt(style.borderTop);
    let borderBottom = parseInt(style.borderBottom);
    
    contentInput.style.height = (scrollHeight + borderTop + borderBottom) + "px";
  }
  
  window.addEventListener("load", () => {
    const allCommentTextareas = document.querySelectorAll('.review_content');
    allCommentTextareas.forEach((textarea) => {
      loadResize(textarea); 
    });
  });
  window.onresize = () => {
    const allCommentTextareas = document.querySelectorAll('.review_content');
    allCommentTextareas.forEach((textarea) => {
      loadResize(textarea);
    });
  };
</script>