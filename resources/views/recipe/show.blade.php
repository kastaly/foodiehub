<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Show Recipe') }}
        </h2>
    </x-slot>
    <div class="container py-8 mx-auto">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <!-- Image -->
                <div class="relative">
                    <img class="w-full md:h-auto" src="{{ asset('storage/'.$recipe->image) }}" alt="{{ $recipe->title }}">
                    <!-- Title Over Image -->
                    <div class="absolute bottom-0 left-0 w-full bg-gray-900 bg-opacity-50 p-4">
                        <h2 class="text-2xl font-bold text-white">{{ $recipe->title }}</h2>
                    </div>
                </div>
                <!-- Recipe Details -->
                <div class="p-6">
                    <!-- Ingredients -->
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Ingredients:</h3>
                        <ul class="list-disc list-inside text-gray-600 dark:text-gray-300">
                            @foreach (explode("\n", $recipe->ingredients) as $ingredient)
                                <li>{{ $ingredient }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Steps -->
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Steps:</h3>
                        <ol class="list-decimal list-inside text-gray-600 dark:text-gray-300">
                            @foreach (explode("\n", $recipe->steps) as $step)
                                <li>{{ $step }}</li>
                            @endforeach
                        </ol>
                    </div>
                    <!-- Recipe Meta -->
                    <div class="flex flex-wrap items-center mb-4">
                        <div class="flex items-center mr-4">
                            <span class="font-bold text-gray-700 dark:text-gray-300">User:</span>
                            <div class="flex items-center ml-2">
                                @if ($recipe->user->is_avatar)
                                    <img src="{{ asset($recipe->user->profile_picture) }}" class="rounded-full w-8 h-8 mr-2 object-cover">
                                @else
                                    <img src="{{ asset('storage/' . $recipe->user->profile_picture) }}" class="rounded-full w-8 h-8 mr-2 object-cover">
                                @endif
                                <span class="text-gray-600 dark:text-gray-300">{{ $recipe->user->name }}</span>
                            </div>
                        </div>
                        <div class="flex items-center mr-4">
                            <span class="font-bold text-gray-700 dark:text-gray-300">Modified At:</span>
                            <span class="text-gray-600 dark:text-gray-300">{{ $recipe->updated_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex items-center mr-4">
                            <span class="font-bold text-gray-700 dark:text-gray-300">Created At:</span>
                            <span class="text-gray-600 dark:text-gray-300">{{ $recipe->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex items-center mr-4">
                            <span class="font-bold text-gray-700 dark:text-gray-300">Category:</span>
                            <span class="text-gray-600 dark:text-gray-300">{{ $recipe->category_name }}</span>
                        </div>
                        <div class="flex items-center mr-4">
                            <span class="font-bold text-gray-700 dark:text-gray-300">Total Time:</span>
                            <span class="text-gray-600 dark:text-gray-300">{{ $recipe->total_time }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold text-gray-700 dark:text-gray-300">Serving Size:</span>
                            <span class="text-gray-600 dark:text-gray-300">{{ $recipe->servings }}</span>
                        </div>
                    </div>
                    <div class="text-white">
                        number of views : {{$views }}
                    </div>
                    <!-- Modify Button -->
                    @if(Auth::check() && Auth::user()->id === $recipe->user_id)
                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">Modify</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
