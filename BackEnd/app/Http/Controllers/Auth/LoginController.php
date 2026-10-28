<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return $this->sendUserToHome(request());
        }

        return view('pages.index');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+\-]+@gmail\.com$/i'],
            'password' => ['required', 'string'],
        ], [
            'email.regex' => 'Hanya email @gmail.com yang diperbolehkan.',
        ]);

        $remember = $request->boolean('remember');

        if (! Auth::attempt($credentials + ['password' => $credentials['password']], $remember)) {
            throw ValidationException::withMessages([
                'email' => 'Email atau kata sandi salah.',
            ]);
        }

        $request->session()->regenerate();

        return $this->sendUserToHome($request);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Anda telah keluar dari akun.');
    }

    protected function sendUserToHome(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user && $user->isAdmin()) {
            $intended = session()->pull('url.intended');
            if ($intended && str_contains($intended, '/admin')) {
                return redirect()->to($intended);
            }

            return redirect()->route('admin.dashboard');
        }

        $intended = session()->pull('url.intended');
        if ($intended && ! str_contains($intended, '/login') && $intended !== url('/')) {
            return redirect()->to($intended);
        }

        return redirect()->route('search.index');
    }
}
