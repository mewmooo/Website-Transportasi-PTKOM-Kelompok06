<?php

namespace App\Http\Controllers;

use App\Models\HelpReport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HelpController extends Controller
{
    public function index(): View
    {
        return view('pages.help');
    }

    public function terms(): View
    {
        return view('pages.terms');
    }

    public function privacy(): View
    {
        return view('pages.privacy');
    }

    public function submitMessage(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:25'],
            'category' => ['required', 'string'],
            'booking_code' => ['nullable', 'string', 'max:50'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        HelpReport::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'category' => $validated['category'],
            'booking_code' => $validated['booking_code'],
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        return redirect()->route('help')->with(
            'status',
            'Pesan bantuan Anda telah berhasil dikirim dan masuk ke sistem antrean Customer Service TiketBus! Kami akan menghubungi email Anda (' . e($validated['email']) . ') dalam 1x24 jam.'
        );
    }
}

