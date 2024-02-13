<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Make image field required
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        $imageName = null; // Initialize $imageName with a default value

        if ($request->hasFile('profile_picture')) {
            $imageName = time().'.'.$request->file('profile_picture')->getClientOriginalExtension();
            $request->file('profile_picture')->move(public_path('storage/profile-images'), $imageName); 
            // continue with storing the image name in the database or any other necessary steps
        }
        $user = User::create([
            'name' => $request->name,
            'image' => $imageName, // Save the image name to the 'image' field in the database
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect(RouteServiceProvider::HOME)->with('success', 'Avatar updated successfully.');
    }
}
