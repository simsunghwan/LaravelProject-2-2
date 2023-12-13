<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('메인화면') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <form action="{{ route('search') }}" method="GET" class="flex mb-4 items-center">
            <label for="query" class="font-medium text-2xl mr-2 text-gray-700">리뷰 검색: </label>
            <x-text-input type="text" id="query" class="flex-1  " name="query" placeholder="검색어를 입력하세요"></x-text-input>
            <select id="category" name="category"
              class='border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md overflow-hidden shadow-sm w-auto'>
              @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
            <x-primary-button class="ml-2">검색</x-primary-button>
          </form>
          <hr />
          <!-- 카테고리 설명 -->
          <h2 class="text-2xl font-bold my-4">카테고리</h2>
          @foreach($categories as $category)
          <div class="bg-gray-200 p-4 my-2 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">{{ $category->name }}</h3>
            <p class="text-gray-700">
              {{ $category->description }}
            </p>
          </div>
          @endforeach


        </div>
      </div>
    </div>
  </div>
</x-app-layout>