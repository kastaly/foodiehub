<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('All Recipes') }}
      </h2>
  </x-slot>

  <div class="container py-8 mx-auto">
      <div class="max-w-7xl mx-auto flex">
          <!-- Sidebar -->
          <div class="w-1/4 pr-4">
              <h3 class="text-lg font-semibold mb-4">Categories</h3>
              <ul class="space-y-2">
                  @foreach($categories as $category)
                      <li>{{ $category->name }}</li>
                  @endforeach
              </ul>
          </div>

          <!-- Main Content -->
          <div class="w-3/4 pl-4">
              <!-- Search and Filter -->
              <div class="flex justify-between mb-6">
                  <!-- Search Input -->
                  <div class="w-1/3">
                      <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search Recipes</label>
                      <input type="text" name="search" id="search" placeholder="Search recipes" class="form-input w-full focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-blue-500 dark:border-gray-600">
                  </div>

                  <!-- Filter Dropdown -->
                  <div class="w-1/3">
                      <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter by Category</label>
                      <select name="category" id="category" class="form-select w-full focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-blue-500 dark:border-gray-600">
                          <option value="">All Categories</option>
                          @foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                      </select>
                  </div>

                  <!-- Filter Button -->
                  <div class="w-1/3 flex items-end justify-end">
                      <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">Filter</button>
                  </div>
              </div>

              <!-- Recipe Cards -->
              <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                  @foreach ($recipes as $recipe)
                      <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                          <div class="h-48 bg-cover bg-center relative" style="background-image: url('{{ asset('storage/' . $recipe->image) }}')">
                              <span class="absolute top-0 left-0 bg-blue-500 text-white px-2 py-1 rounded-bl">Total Time: {{ $recipe->total_time }} mins</span>
                          </div>
                          <div class="p-6">
                              <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">{{ $recipe->title }}</h2>
                              <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $recipe->created_at->format('M d, Y') }}</p>
                              <p class="text-gray-700 dark:text-gray-400">{{ $recipe->steps }}</p>
                          </div>
                          <div class="flex items-center justify-between px-6 py-4 bg-gray-100 dark:bg-gray-700">
                              <div class="flex items-center">
                                  @if ($recipe->user->is_avatar)
                                      <img src="{{ asset($recipe->user->profile_picture) }}" class="rounded-full w-8 h-8 mr-2 object-cover">
                                  @else
                                      <img src="{{ asset('storage/' . $recipe->user->profile_picture) }}" class="rounded-full w-8 h-8 mr-2 object-cover">
                                  @endif
                                  <span class="text-gray-700 dark:text-gray-300">{{ $recipe->user->name }}</span>
                              </div>
                              <a href="{{ route('recipes.show', $recipe->id) }}" class="text-blue-500 dark:text-blue-400 hover:underline">Show Recipe</a>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
