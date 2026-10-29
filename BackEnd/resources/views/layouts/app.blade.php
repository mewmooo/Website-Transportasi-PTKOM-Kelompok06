<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'TiketBus')</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
@stack('head')
</head>
<body>

<header class="topbar">
  <div class="topbar-inner">
    <a href="{{ route('search.index') }}" class="brand">
      <span class="brand-mark"><i class="bi bi-bus-front"></i></span>
      <span class="brand-text">Tiket<span class="brand-green">Bus</span></span>
    </a>
    <input type="checkbox" id="navToggle" class="nav-toggle-cb"><label for="navToggle" class="nav-toggle-label"><i class="bi bi-list"></i></label>
    <nav class="nav">
      <a href="{{ route('search.index') }}" class="{{ request()->routeIs('search.index', 'results', 'schedules.*') ? 'active' : '' }}">
        <i class="bi bi-search" style="margin-right:4px;"></i> Cari Tiket
      </a>
      <a href="{{ route('profile.show') }}" class="{{ request()->routeIs('profile.*', 'bookings.*', 'tickets.*') ? 'active' : '' }}">
        <i class="bi bi-ticket-perforated" style="margin-right:4px;"></i> Cek Pesanan
      </a>
      <a href="{{ route('help') }}" class="{{ request()->routeIs('help*') ? 'active' : '' }}">
        <i class="bi bi-question-circle" style="margin-right:4px;"></i> Bantuan
      </a>
      <div class="nav-divider"></div>
      @auth
        @if (auth()->user()->isAdmin())
          <a href="{{ route('admin.dashboard') }}" class="btn-account" style="background:var(--green-700);color:#fff;display:inline-flex;align-items:center;gap:6px;">
            <i class="bi bi-grid-fill"></i> Dashboard Admin
          </a>
        @endif
        <a href="{{ route('profile.show') }}" class="btn-account outline" style="display:inline-flex;align-items:center;gap:6px;">
          <i class="bi bi-person-circle"></i> {{ \Illuminate\Support\Str::of(auth()->user()->name)->before(' ') }}
        </a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit" class="btn-account" style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;">
            <i class="bi bi-box-arrow-right"></i> Keluar
          </button>
        </form>
      @else
        <a href="{{ route('login') }}" class="btn-account outline" style="display:inline-flex;align-items:center;gap:6px;">
          <i class="bi bi-person"></i> Masuk/Daftar
        </a>
      @endauth
    </nav>
  </div>
</header>

@if (session('status'))
  <div class="container" style="margin-top:18px;">
    <div class="flash flash-success">{{ session('status') }}</div>
  </div>
@endif

@if (session('error'))
  <div class="container" style="margin-top:18px;">
    <div class="flash flash-error">{{ session('error') }}</div>
  </div>
@endif

@if ($errors->any())
  <div class="container" style="margin-top:18px;">
    <div class="flash flash-error">
      <strong>Mohon periksa kembali isian Anda:</strong>
      <ul style="margin:6px 0 0 18px;">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
@endif

<main>@yield('content')</main>

<footer class="site-footer">
  <div class="container">
    <div class="footer-brand" style="display:inline-flex;align-items:center;gap:10px;font-size:18px;font-weight:800;letter-spacing:-0.01em;">
      <span class="brand-mark"><i class="bi bi-bus-front"></i></span>
      <span style="color:#ffffff;">Tiket<span class="brand-green">Bus</span></span>
    </div>
    <div class="footer-links">
      <a href="{{ route('terms') }}"><i class="bi bi-file-earmark-text"></i> Syarat &amp; Ketentuan</a>
      <a href="{{ route('privacy') }}"><i class="bi bi-shield-check"></i> Kebijakan Privasi</a>
      <a href="{{ route('help') }}"><i class="bi bi-question-circle"></i> Bantuan</a>
      <a href="{{ route('help') }}#kontak"><i class="bi bi-headset"></i> Hubungi Kami</a>
    </div>
  </div>
</footer>

</body>
</html>
