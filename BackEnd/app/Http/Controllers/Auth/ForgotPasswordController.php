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

        // Kirim notifikasi email langsung ke email pengguna
        try {
            $user->sendPasswordResetNotification($token);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mengirim email reset: '.$e->getMessage());

            return back()->with('error', 'Gagal mengirim email: '.$e->getMessage().'. Pastikan konfigurasi MAIL_USERNAME dan MAIL_PASSWORD di .env sudah benar.');
        }

        $isSmtp = config('mail.default') === 'smtp';

        $message = $isSmtp
            ? 'Tautan reset kata sandi telah dikirim ke '.$user->email.'. Silakan periksa Kotak Masuk (Inbox) atau folder Spam Anda.'
            : 'Tautan reset kata sandi telah berhasil dibuat.';

        $redirect = back()->with('status', $message);

        // Jika belum menggunakan SMTP asli, tampilkan tombol instan agar tetap bisa dites
        if (! $isSmtp) {
            $redirect->with('reset_url', $resetUrl);
        }

        return $redirect;
    }
}
