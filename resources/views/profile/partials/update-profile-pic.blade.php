<section class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-8 grid grid-cols-1 sm:grid-cols-2 gap-8">
    <!-- Left Half: Current Profile Picture and User Info -->
    <div class="pb-8 sm:col-span-1 sm:justify-self-center">
        <header>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
                {{ __('Update Profile Picture') }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('You can choose one of our avatars or upload your own image.') }}
            </p>
        </header>

        <div class="flex flex-col items-center mt-6">
            <div class="relative">
                <div class="rounded-full overflow-hidden border-4 border-orange-500 animate-pulse">
                    @if (Auth::user()->is_avatar)
                        <img src="{{ asset(Auth::user()->profile_picture) }}" alt="Current Profile Picture" class="w-40 h-40 rounded-full profile-image mx-auto object-cover">
                    @else
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Current Profile Picture" class="w-40 h-40 rounded-full profile-image mx-auto object-cover">
                    @endif
                </div>
            </div>
            <div>
                <span class="block text-sm font-medium text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</span>
                <span class="block text-sm text-gray-600 dark:text-gray-400">{{ Auth::user()->email }}</span>
            </div>
        </div>
    </div>

    <!-- Right Half: Choose Avatar or Upload Own Image -->
    <div class="pt-16 ">
        <form method="POST" action="{{ route('profile.updateProfilePicture') }}" enctype="multipart/form-data">
            @csrf

            <!-- Choose Avatar Section -->
            <div>
                <x-input-label for="avatar" :value="__('Choose Avatar')" />
                <div class="grid grid-cols-4 gap-4 mt-2">
                    @foreach ($avatars as $avatar)
                        <label for="avatar{{ $loop->index }}" class="flex flex-col items-center justify-center cursor-pointer">
                            <img src="{{ asset($avatar) }}" alt="Avatar" class="w-20 h-20 rounded-full avatar-preview">
                            <input type="radio" id="avatar{{ $loop->index }}" name="avatar" value="{{ $avatar }}" class="hidden avatar-radio">
                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ basename($avatar) }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Upload Own Image Section -->
            <div class='pt-12'>
                <x-input-label for="profile_image" :value="__('Upload Your Own Image')" class="text-white pb-4" />
                <input id="profile_image" type="file" name="profile_picture" class="mt-1 block w-full profile-image-input" accept="image/*">
                <x-input-error :messages="$errors->get('profile_image')" class="mt-2" />
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-center pt-8 sm:pt-0 sm:col-span-1">
            <x-primary-button class="px-16 py-3 bg-orange-500">{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-picture-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400 ml-2"
                >{{ __('Profile picture updated successfully.') }}</p>
            @endif
        </div>
    </form>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const avatarRadios = document.querySelectorAll('.avatar-radio');
        const profileImageInput = document.querySelector('.profile-image-input');
        const profileImage = document.querySelector('.profile-image');

        // Add event listeners to avatar radios
        avatarRadios.forEach((radio) => {
            radio.addEventListener('change', () => {
                profileImage.src = radio.value;
            });
        });

        // Add event listener to profile image input
        profileImageInput.addEventListener('change', () => {
            const file = profileImageInput.files[0];
            const reader = new FileReader();

            reader.onload = function(event) {
                profileImage.src = event.target.result;
            };

            reader.readAsDataURL(file);
        });
    });
</script>
