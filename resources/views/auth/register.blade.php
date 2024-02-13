<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900">
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div class="max-w-4xl flex flex-col sm:flex-row bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
        <!-- Left Side: Food Image and Additional Content -->
        <div class="sm:w-1/2 bg-gray-300 dark:bg-gray-700 relative">
            <img src="{{ asset('images/pizzagif.gif') }}" alt="Food Image" class="object-cover w-full h-full">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center px-8">
                <h2 class="text-4xl font-bold mb-4">Join Our Culinary Adventure</h2>
                <p class="text-lg">Discover mouthwatering recipes, cooking tips, and more!</p>
            </div>
        </div>
        <!-- Right Side: Registration Form -->
        <div class="sm:w-1/2 px-8 py-12">
            <h2 class="text-3xl font-semibold text-gray-900 dark:text-gray-100 mb-6 text-center">Sign Up</h2>
            <form method="POST" action="{{ route('register') }}" class="space-y-6" enctype="multipart/form-data">
                @csrf
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <!-- Upload Profile Picture -->
                <div>
                    <x-input-label for="profile_image" :value="__('Upload Profile Picture')" />
                    <input id="profile_image" type="file" name="profile_picture" class="mt-1 block w-full profile-image-input" accept="image/*">
                    <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                </div>
                <!-- Register Button -->
                <div class="flex items-center justify-center">
                    <x-primary-button>
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400 text-center">
                {{ __('Already registered?') }}
                <a href="{{ route('login') }}" class="underline">{{ __('Log in here.') }}</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
