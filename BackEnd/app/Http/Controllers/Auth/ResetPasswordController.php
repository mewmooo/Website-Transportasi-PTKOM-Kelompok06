<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, string $token): View
    {
        return view('pages.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function reset(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+\-]+@gmail\.com$/i'],
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
        ], [
            'email.regex' => 'Hanya email @gmail.com yang diperbolehkan.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user) use ($request) {
            $user->forceFill([
                'password' => $request->password,
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        });

        if ($status !== Password::PASSWORD_RESET) {
            $message = match ($status) {
                Password::INVALID_USER => 'Pengguna dengan email tersebut tidak ditemukan.',
                Password::INVALID_TOKEN => 'Tautan reset kata sandi tidak valid atau sudah kadaluarsa. Silakan ajukan tautan baru.',
                default => 'Gagal mengatur ulang kata sandi. Silakan coba kembali.',
            };

            throw ValidationException::withMessages(['email' => $message]);
        }

        $user = $request->user() ?: \App\Models\User::where('email', $request->email)->first();

        if ($user) {
            \Illuminate\Support\Facades\Auth::login($user);
            if ($request->hasSession()) {
                $request->session()->regenerate();
                $request->session()->forget('url.intended');
            }

            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('status', 'Kata sandi berhasil diperbarui! Selamat datang di Dashboard Admin.');
            }
        }

        return redirect()->route('search.index')->with('status', 'Kata sandi berhasil diperbarui! Anda telah otomatis masuk ke akun Anda.');
    }
}
