@extends("layouts.app")

@section("title", "Lupa Kata Sandi — TiketBus")

@section("content")
<style>
  .auth-wrap{min-height:calc(100vh - 72px);display:flex;align-items:center;justify-content:center;padding:48px 24px;background:var(--cream);}
  .auth-card{width:100%;max-width:440px;padding:36px 32px;}
  .auth-card h1{font-size:22px;margin:0 0 8px;letter-spacing:-0.01em;}
  .auth-card p.sub{margin:0 0 24px;font-size:14px;color:var(--ink-soft);line-height:1.55;}
  .auth-foot{text-align:center;margin-top:20px;font-size:13.5px;color:var(--ink-soft);}
  .auth-foot a{color:var(--green-700);font-weight:800;}
</style>

<div class="auth-wrap">
  <div class="card auth-card">
    <div style="display:flex;align-items:center;gap:10px;font-weight:800;font-size:18px;margin-bottom:24px;letter-spacing:-0.02em;">
      <span class="brand-mark"><i class="bi bi-bus-front"></i></span>
      <span>Tiket<span style="color:#00A76F;">Bus</span></span>
    </div>
    <h1>Lupa kata sandi?</h1>
    <p class="sub">Masukkan email akun Anda. Kami akan mengirimkan tautan untuk mengatur ulang kata sandi.</p>

    @if (session('reset_url'))
      <div style="background:#EBF5F0;border:1.5px solid var(--green-600);border-radius:12px;padding:16px;margin-bottom:20px;text-align:left;">
        <div style="font-weight:800;color:var(--green-800);margin-bottom:6px;display:flex;align-items:center;gap:6px;">
          <span>✅</span> Tautan Reset Berhasil Dibuat!
        </div>
        <p style="font-size:13px;color:var(--ink-soft);margin:0 0 12px;line-height:1.5;">
          Karena berjalan di server lokal, Anda dapat langsung mengklik tombol di bawah ini untuk membuka halaman reset kata sandi:
        </p>
        <a href="{{ session('reset_url') }}" class="btn btn-primary btn-block" style="text-decoration:none;display:block;text-align:center;padding:12px;">
          🔑 Buka Halaman Reset Kata Sandi Sekarang →
        </a>
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf
      <div class="field">
        <label for="email">Alamat Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="nama@gmail.com" pattern="[a-zA-Z0-9._%+\-]+@gmail\.com" title="Hanya email @gmail.com yang diperbolehkan" required autofocus>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Kirim Tautan Reset</button>
    </form>

    <div class="auth-foot">Ingat kata sandi Anda? <a href="{{ route('login') }}">Kembali masuk</a></div>
  </div>
</div>
@endsection
