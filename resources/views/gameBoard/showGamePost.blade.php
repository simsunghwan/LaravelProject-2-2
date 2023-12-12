<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $gamePost->title }}
    </h2>
  </x-slot>

  <div>
    <h2 class="text-2xl font-semibold mb-2">
      {{ $gamePost->title }}
    </h2>
    @if ($gamePost->img_path != null)
    <img alt="" src="{{ asset('storage/' . $gamePost->img_path) }}" class="w-full h-40 object-cover rounded-lg mb-2">
    @else
    <img alt="" src="{{ asset('images/default_image.webp') }}" class="w-full h-40 object-contain rounded-lg mb-2">
    @endif
    <p class="text-gray-700 mb-2">
      {{ $gamePost->user->user_id }}
    </p>
    <!-- 상세 정보 추가 -->
  </div>


</x-app-layout>