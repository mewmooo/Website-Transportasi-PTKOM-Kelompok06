<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect(): RedirectResponse
    {
        if (empty(config('services.google.client_id')) || empty(config('services.google.client_secret'))) {
            return back()->with('error', 'Login Google belum dikonfigurasi. Silakan isi GOOGLE_CLIENT_ID dan GOOGLE_CLIENT_SECRET di file .env.');
        }

        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $email = $googleUser->getEmail();

            // Hanya izinkan domain @gmail.com sesuai aturan website
            if (! str_ends_with(strtolower($email), '@gmail.com')) {
                return redirect()->route('login')->with('error', 'Hanya akun Google dengan domain @gmail.com yang diperbolehkan.');
            }

            // Cari user berdasarkan email, atau buat akun baru otomatis
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $googleUser->getName() ?? 'Pengguna Google',
                    'password' => Str::random(32), // Password acak yang di-hash
                    'role' => 'user',
                    'phone' => '+62 812 0000 0000',
                    'email_verified_at' => now(),
                    'avatar' => $googleUser->getAvatar(),
                ]
            );

            Auth::login($user);
            request()->session()->regenerate();
            session()->forget('url.intended');

            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('search.index')->with('status', 'Berhasil masuk dengan akun Google: '.$user->email);
        } catch (\Throwable $e) {
            return redirect()->route('login')->with('error', 'Gagal masuk dengan Google: '.$e->getMessage());
        }
    }
}

