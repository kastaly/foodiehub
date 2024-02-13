<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Recipe') }}
        </h2>
    </x-slot>

    <div class="container py-8 mx-auto">
        <div class="max-w-4xl mx-auto flex justify-center items-start">
            <!-- Form -->
            <form method="post" action="{{ route('recipes.store') }}" enctype="multipart/form-data" 
                class="w-full lg:w-3/5 xl:w-2/3 px-6 py-8 bg-white dark:bg-gray-800 shadow-md rounded-lg">
                @csrf
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Share Your Recipe</h3>
                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter the title of your recipe" required
                        class="form-input w-full mt-1 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-orange-500 dark:border-gray-600">
                </div>
                <!-- Category -->
                <div class="mb-6">
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                    <select name="category_id" id="category" required
                        class="form-select w-full mt-1 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-orange-500 dark:border-gray-600">
                        <option value="" selected disabled>Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Steps -->
                <div class="mb-6">
                    <label for="steps" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Steps</label>
                    <textarea name="steps" id="steps" rows="4" placeholder="Enter the steps to prepare the recipe" required
                        class="form-textarea w-full mt-1 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-orange-500 dark:border-gray-600"></textarea>
                </div>
                <!-- Ingredients -->
                <div class="mb-6">
                    <label for="ingredients" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ingredients</label>
                    <textarea name="ingredients" id="ingredients" rows="4" placeholder="Enter the ingredients required" required
                        class="form-textarea w-full mt-1 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-orange-500 dark:border-gray-600"></textarea>
                </div>
                <!-- Total Time and Servings -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="total_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Total Time (minutes)</label>
                        <input type="number" name="total_time" id="total_time" placeholder="Enter total preparation time" required
                            class="form-input w-full mt-1 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-orange-500 dark:border-gray-600">
                    </div>
                    <div>
                        <label for="servings" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Servings</label>
                        <input type="number" name="servings" id="servings" placeholder="Enter the number of servings" required
                            class="form-input w-full mt-1 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-orange-500 dark:border-gray-600">
                    </div>
                </div>
                <!-- Image -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Image</label>
                    <input type="file" name="image" id="image" required
                        class="form-input w-full mt-1 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-orange-500 dark:border-gray-600">
                </div>
                <!-- Video -->
                <div class="mb-6">
                    <label for="video" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Video (optional)</label>
                    <input type="file" name="video" id="video"
                        class="form-input w-full mt-1 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-orange-500 dark:border-gray-600">
                </div>
                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400">Submit Recipe</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
