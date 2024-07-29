<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // callback function
    public function callback($provider)
    {
        $totalUser =  User::count();
        if ($totalUser <= 0) {
            return redirect()->route('register')->withErrors(['message' => 'First user cannot use social button to login']);
        }
        try {
            $getUser = Socialite::driver($provider)->user();
            if ($getUser->email) {
                $user = User::where('email', $getUser->email)->first();
                if ($getUser->avatar) {
                    $avatarContent = file_get_contents($getUser->avatar);
                    $filename = uniqid() . '_' . now()->timestamp . '.jpg';
                    if ($user && $user->profile_photo_path && $user->status !== 0) {
                        Storage::disk('public')->delete($user->profile_photo_path);
                    }
                    Storage::disk('public')->put('profile-photos/' . $filename, $avatarContent);
                }
                if ($user) {
                    if ($user->status !== 0) {
                        $user->update([
                            'social' => $getUser->id,
                            'name' => $getUser->name,
                            'profile_photo_path' => 'profile-photos/' . $filename,
                        ]);
                        Auth::login($user);
                        return redirect()->route('/redirect');
                    } else {
                        return redirect()->route('login')->withErrors(['LoginError' => 'Your account is blocked. Try to login with another account.']);
                    }
                } else {
                    $cleanName = preg_replace('/[^a-zA-Z0-9]+/', '', $getUser->name);
                    $userId = Str::slug($cleanName);
                    $baseUserId = $userId;
                    $counter = 1;
                    while (User::where('u_id', $userId)->exists()) {
                        $randomString = Str::random(6);
                        $userId = $baseUserId . '-' . $randomString;
                        $counter++;
                    }
                    $randomPass = Str::random(16);
                    $addUser = User::create([
                        'u_id'=>$userId,
                        'social' => $getUser->id,
                        'email' => $getUser->email,
                        'name' => $getUser->name,
                        'password' => Hash::make($randomPass),
                        'profile_photo_path' => 'profile-photos/' . $filename,
                    ]);
                    
                    Auth::login($addUser);
                    return redirect()->intended(route('home'))->with([
                        'type' => 'success',
                        'title'=> 'Welcome to '.config('app.name'),
                        'message'=> 'Your have default password now - ',
                        'loggedIn'=> $randomPass,
                        'route'=>'profile.show',
                    ]);
                }
            } else {
                return redirect()->route('login')->withErrors(['LoginError' => 'Sorry, your email is private. Try to login with another account.']);
            }
        } catch (Exception $e) {
            return redirect()->route('login')->withErrors(['message' => $e->getMessage()]);
        }
    }
}