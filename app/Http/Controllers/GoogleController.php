<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Kita beri nama $googleUser agar tidak bentrok dengan model User
            $googleUser = Socialite::driver('google')->user();
            
            // Cari user berdasarkan google_id
            $finduser = User::where('google_id', $googleUser->getId())->first();

            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('/');
            } else {
                // Jika user belum ada, buat baru
                $newUser = User::updateOrCreate(['email' => $googleUser->getEmail()], [
                    'name' => $googleUser->getName(),
                    'google_id'=> $googleUser->getId(),
                    'password' => bcrypt('123456dummy')
                ]);

                Auth::login($newUser);
                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            return redirect('/')->with('error', 'Gagal login: ' . $e->getMessage());
        }
    }
}