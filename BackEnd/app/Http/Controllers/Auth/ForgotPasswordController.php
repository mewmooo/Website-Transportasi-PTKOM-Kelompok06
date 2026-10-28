<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm(): View
    {
        return view('pages.forgot-password');
    }

    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+\-]+@gmail\.com$/i'],
        ], [
            'email.regex' => 'Hanya email @gmail.com yang diperbolehkan.',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => 'Alamat email tersebut tidak terdaftar di sistem kami.',
            ]);
        }

        // Buat token reset password yang sah
        $token = Password::broker()->createToken($user);

        // Buat tautan reset lengkap sesuai host & port saat ini
        $resetUrl = url(route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ], false));

        // Kirim notifikasi email (tercatat di storage/logs/laravel.log atau SMTP)
        try {
            $user->sendPasswordResetNotification($token);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Notifikasi reset email tidak terkirim via mailer: '.$e->getMessage());
        }

        return back()
            ->with('status', 'Tautan reset kata sandi telah berhasil dibuat.')
            ->with('reset_url', $resetUrl);
    }
}
