<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $avatars = [
            'avatars\avatar.jpg',
            'avatars\avatar1.jpg',
            'avatars\avatar2.png',
            'avatars\avatar3.png',
            'avatars\avatar4.jpg',
            'avatars\avatar5.jpg',
            'avatars\avatar6.jpg',
            'avatars\avatar7.jpg',
            
            // Add paths for the other avatars
        ];
    
        return view('profile.edit', [
            'user' => $request->user(),
            'avatars' => $avatars, // Pass the avatars to the view
        ]);
    }

    /**
     * Update the user's profile information.
     */

     public function updateProfilePicture(Request $request): RedirectResponse
     {
         // Determine if the user selected an avatar or uploaded their own image
         if ($request->has('avatar')) {
             $user = $request->user();
             $user->profile_picture = $request->avatar; // Set the image path as selected avatar
             $user->is_avatar = true; // Set the flag to indicate it's an avatar
             $user->save();
         } else {
             // Process user-uploaded image as before
             $request->validate([
                 'profile_picture' => ['required', 'image', 'max:2048'],
             ]);
     
             $user = $request->user();
     
             $imagePath = $request->file('profile_picture')->storePublicly('profile-images', 'public');

     
             $user->profile_picture = $imagePath;
             $user->is_avatar = false; // Set the flag to indicate it's a user-uploaded image
             $user->save();
         }
     
         return redirect()->route('profile.updateProfilePicture')->with('status', 'profile-picture-updated');
     }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
