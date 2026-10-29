@extends("layouts.app")

@section("title", "Profil Saya — TiketBus")

@section("content")
@php
  $initials = $user->initials() ?: 'U';
  $joined = $user->created_at->locale('id')->translatedFormat('F Y');
@endphp

<style>
  .profile-container { padding: 32px 0 64px; }
  
  .profile-shell {
    display: grid;
    grid-template-columns: 260px 1fr;
    gap: 28px;
    align-items: start;
  }

  /* Sidebar Design Matching Admin */
  .profile-side {
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    border-radius: 14px;
    padding: 16px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    position: sticky;
    top: 88px;
  }

  .profile-user-card {
    background: #EEF4FF;
    border-radius: 12px;
    padding: 14px 12px;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
  }

  .profile-user-card .av {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #D1E0FF;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    color: #1E40AF;
    font-size: 14px;
    flex-shrink: 0;
  }

  .profile-user-card .name {
    color: #111827;
    font-weight: 700;
    font-size: 13.5px;
    line-height: 1.25;
  }

  .profile-user-card .sub {
    font-size: 11px;
    color: #6B7280;
    margin-top: 2px;
    line-height: 1.2;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 145px;
  }

  .profile-user-card .badge-priority {
    display: inline-block;
    background: #FEF3C7;
    color: #92400E;
    font-size: 10px;
    font-weight: 800;
    padding: 2px 6px;
    border-radius: 4px;
    margin-top: 4px;
  }

  /* Nav Links Matching Admin Layout */
  .profile-nav {
    display: flex;
    flex-direction: column;
    gap: 3px;
  }

  .profile-nav a, .profile-nav button.logout-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 14px;
    border-radius: 10px;
    font-size: 13.5px;
    font-weight: 600;
    color: #4B5563;
    text-decoration: none;
    transition: all .15s ease;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
    font-family: inherit;
  }

  .profile-nav a i, .profile-nav button.logout-btn i {
    font-size: 17px;
    width: 20px;
    text-align: center;
    color: #6B7280;
    transition: color .15s ease;
  }

  .profile-nav a:hover, .profile-nav button.logout-btn:hover {
    background: #F3F4F6;
    color: #111827;
  }

  .profile-nav a:hover i, .profile-nav button.logout-btn:hover i {
    color: #111827;
  }

  .profile-nav a.active {
    background: #E8F8F0;
    color: #00A76F;
    font-weight: 700;
  }

  .profile-nav a.active i {
    color: #00A76F;
  }

  .profile-nav .nav-divider {
    height: 1px;
    background: #E5E7EB;
    margin: 12px 0;
  }

  .profile-nav .logout-btn:hover {
    background: #FEE2E2;
    color: #DC2626;
  }

  .profile-nav .logout-btn:hover i {
    color: #DC2626;
  }

  .profile-nav form { margin: 0; }

  /* KPI Grid Matching Admin */
  .kpi-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 24px;
  }

  .kpi-card {
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
  }

  .kpi-card .lbl {
    font-size: 12.5px;
    color: var(--ink-soft);
    margin-bottom: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 600;
  }

  .kpi-card .val {
    font-size: 24px;
    font-weight: 800;
    color: #111827;
  }

  .kpi-card .sub {
    font-size: 11.5px;
    color: var(--ink-soft);
    margin-top: 4px;
  }

  /* Main Card Layout */
  .profile-block {
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    border-radius: 14px;
    padding: 26px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    margin-bottom: 24px;
  }

  .block-header {
    border-bottom: 1px solid #F3F4F6;
    padding-bottom: 16px;
    margin-bottom: 20px;
  }

  .block-title {
    font-size: 16px;
    font-weight: 800;
    color: #111827;
    margin: 0 0 4px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .block-title i {
    color: #00A76F;
    font-size: 18px;
  }

  .block-sub {
    font-size: 12.5px;
    color: var(--ink-soft);
    margin: 0;
  }

  /* Form Elements */
  .field-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
  }

  .field label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 6px;
    color: #374151;
  }

  .field input, .field select {
    width: 100%;
    padding: 11px 14px;
    border: 1.5px solid #E5E7EB;
    border-radius: 9px;
    font-size: 13.5px;
    background: #fff;
    font-family: inherit;
    transition: border-color .15s;
  }

  .field input:focus, .field select:focus {
    border-color: #00A76F;
    outline: none;
  }

  .btn-submit {
    background: #00A76F;
    color: #fff;
    padding: 10px 20px;
    border-radius: 9px;
    font-weight: 700;
    font-size: 13.5px;
    border: none;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    font-family: inherit;
    transition: background .15s;
  }

  .btn-submit:hover {
    background: #008f5d;
    color: #fff;
  }

  .btn-cancel {
    background: #fff;
    border: 1.5px solid #E5E7EB;
    color: #4B5563;
    padding: 9px 18px;
    border-radius: 9px;
    font-weight: 700;
    font-size: 13px;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    font-family: inherit;
  }

  .btn-cancel:hover {
    background: #F9FAFB;
  }

  .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 14px;
  }

  /* Trip Item */
  .trip-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;
    border: 1px solid #E5E7EB;
    border-radius: 12px;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 12px;
    background: #FDFDFD;
    transition: border-color .15s;
  }

  .trip-row:hover {
    border-color: #00A76F;
  }

  .trip-info {
    display: flex;
    align-items: center;
    gap: 16px;
  }

  .trip-info .t {
    font-weight: 700;
    font-size: 14px;
    color: #111827;
  }

  .trip-info .p {
    font-size: 12px;
    color: var(--ink-soft);
    margin-top: 2px;
  }

  .empty-state {
    text-align: center;
    padding: 32px 16px;
    color: var(--ink-soft);
    font-size: 13.5px;
  }

  .pay-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
  }

  .pay-card {
    border: 1px solid #E5E7EB;
    border-radius: 12px;
    padding: 18px;
    background: #FAFAFA;
  }

  .pay-card b {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 6px;
    font-size: 14px;
    color: #111827;
  }

  .pay-card span {
    color: var(--ink-soft);
    font-size: 12px;
    line-height: 1.5;
    display: block;
  }

  @media (max-width: 900px) {
    .profile-shell { grid-template-columns: 1fr; }
    .kpi-grid { grid-template-columns: 1fr; }
    .profile-side { position: static; }
    .pay-grid { grid-template-columns: 1fr; }
    .field-row { grid-template-columns: 1fr; }
  }
</style>

<div class="container profile-container">

  <div class="profile-shell">

    <!-- Left Sidebar Matching Admin Style -->
    <aside class="profile-side">
      <div class="profile-user-card">
        <div class="av">{{ $initials }}</div>
        <div>
          <div class="name">{{ $user->name }}</div>
          <div class="sub">{{ $user->email }}</div>
          @if ($user->points >= 1000)
            <span class="badge-priority"><i class="bi bi-star-fill"></i> Priority Member</span>
          @endif
        </div>
      </div>

      <nav class="profile-nav" id="profileNav">
        <a href="#data-diri" class="nav-item active">
          <i class="bi bi-person"></i>
          <span>Data Diri &amp; Akun</span>
        </a>
        <a href="#riwayat" class="nav-item">
          <i class="bi bi-ticket-perforated"></i>
          <span>Riwayat Tiket &amp; Perjalanan</span>
        </a>
        <a href="#metode-pembayaran" class="nav-item">
          <i class="bi bi-credit-card"></i>
          <span>Metode Pembayaran</span>
        </a>
        <a href="#keamanan" class="nav-item">
          <i class="bi bi-shield-check"></i>
          <span>Keamanan Akun</span>
        </a>

        <div class="nav-divider"></div>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="logout-btn">
            <i class="bi bi-box-arrow-right"></i>
            <span>Keluar</span>
          </button>
        </form>
      </nav>
    </aside>

    <!-- Right Main Column -->
    <main>

      <!-- KPI Grid Styled Matching Admin -->
      <div class="kpi-grid">
        <div class="kpi-card">
          <div class="lbl">
            <span>Total Perjalanan</span>
            <i class="bi bi-bus-front" style="color:var(--green-600);font-size:18px;"></i>
          </div>
          <div class="val">{{ $stats['trips'] }} Bus</div>
          <div class="sub">Perjalanan yang telah selesai</div>
        </div>
        <div class="kpi-card">
          <div class="lbl">
            <span>Tiket Aktif</span>
            <i class="bi bi-ticket-perforated" style="color:#0284C7;font-size:18px;"></i>
          </div>
          <div class="val">{{ $stats['active'] }} Tiket</div>
          <div class="sub">Siap untuk keberangkatan</div>
        </div>
        <div class="kpi-card">
          <div class="lbl">
            <span>Poin TiketBus</span>
            <i class="bi bi-award" style="color:#D97706;font-size:18px;"></i>
          </div>
          <div class="val">{{ number_format($stats['points'], 0, ',', '.') }} Pts</div>
          <div class="sub">Bergabung sejak {{ $joined }}</div>
        </div>
      </div>

      <!-- Section 1: Data Diri & Akun -->
      <section class="profile-block" id="data-diri">
        <div class="block-header">
          <h2 class="block-title">
            <i class="bi bi-person-lines-fill"></i>
            <span>Informasi Pribadi &amp; Akun</span>
          </h2>
          <p class="block-sub">Perbarui data diri Anda untuk kemudahan verifikasi dan pemesanan tiket bus.</p>
        </div>

        <form method="POST" action="{{ route('profile.update') }}">
          @csrf
          @method('PUT')
          <div class="field-row">
            <div class="field">
              <label>Nama Lengkap Sesuai KTP</label>
              <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="field">
              <label>Nomor Induk Kependudukan (NIK)</label>
              <input type="text" name="nik" value="{{ old('nik', $user->nik) }}" maxlength="16" pattern="[0-9]{16}" placeholder="16 digit angka">
            </div>
          </div>

          <div class="field-row">
            <div class="field">
              <label>
                Alamat Email 
                @if($user->email_verified_at)
                  <span class="tag tag-green" style="margin-left:6px;font-size:11px;">Terverifikasi</span>
                @endif
              </label>
              <input type="email" name="email" value="{{ old('email', $user->email) }}" pattern="[a-zA-Z0-9._%+\-]+@gmail\.com" title="Hanya email @gmail.com yang diperbolehkan" required>
            </div>
            <div class="field">
              <label>Nomor Ponsel (WhatsApp Aktif)</label>
              <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" pattern="[\d\+\-\s]+" title="Nomor HP hanya boleh berisi angka, tanda +, dan strip" required>
            </div>
          </div>

          <div class="field-row">
            <div class="field">
              <label>Tanggal Lahir</label>
              <input type="date" name="birth_date" value="{{ old('birth_date', $user->birth_date?->format('Y-m-d')) }}">
            </div>
            <div class="field">
              <label>Jenis Kelamin</label>
              <div style="display:flex;gap:10px;">
                <label class="checkbox-row" style="border:1.5px solid #E5E7EB;padding:11px 16px;border-radius:9px;flex:1;font-weight:700;color:var(--ink);display:flex;align-items:center;gap:8px;cursor:pointer;">
                  <input type="radio" name="gender" value="male" @checked(old('gender', $user->gender) === 'male')> Pria
                </label>
                <label class="checkbox-row" style="border:1.5px solid #E5E7EB;padding:11px 16px;border-radius:9px;flex:1;font-weight:700;color:var(--ink);display:flex;align-items:center;gap:8px;cursor:pointer;">
                  <input type="radio" name="gender" value="female" @checked(old('gender', $user->gender) === 'female')> Wanita
                </label>
              </div>
            </div>
          </div>

          <div class="form-actions">
            <a href="{{ route('profile.show') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-submit">
              <i class="bi bi-check-lg"></i> Simpan Perubahan
            </button>
          </div>
        </form>
      </section>

      <!-- Section 2: Riwayat Tiket & Perjalanan -->
      <section class="profile-block" id="riwayat">
        <div class="block-header" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;">
          <div>
            <h2 class="block-title">
              <i class="bi bi-ticket-perforated"></i>
              <span>Perjalanan Mendatang</span>
            </h2>
            <p class="block-sub">Tiket yang siap digunakan untuk keberangkatan antarkota</p>
          </div>
          <span style="font-size:13px;font-weight:800;color:var(--green-700);">{{ $upcoming->count() }} Tiket Siap</span>
        </div>

        @forelse ($upcoming as $booking)
          @php
            $passenger = $booking->passengers->first();
            $firstStop = $booking->schedule->stops->first();
            $lastStop = $booking->schedule->stops->last();
          @endphp
          <div class="trip-row">
            <div class="trip-info">
              <span class="tag tag-{{ $booking->schedule->bus->busClass->badge }}">{{ $booking->schedule->bus->busClass->name }}</span>
              <div>
                <div class="t">{{ $booking->schedule->operator->name }} · Armada {{ $booking->schedule->bus->code }}</div>
                <div class="p">
                  {{ time_short($booking->schedule->departure_time) }} {{ $firstStop?->name }}
                  → {{ time_short($booking->schedule->arrival_time) }} {{ $lastStop?->name }}
                  · {{ $booking->schedule->durationText() }}
                </div>
              </div>
            </div>
            <div style="text-align:right;">
              <div class="muted" style="font-size:11.5px;">
                {{ $booking->schedule->service_date->locale('id')->translatedFormat('D, d M Y') }} · Kursi: {{ $passenger?->seat_no ?? '—' }}
              </div>
              <a href="{{ route('tickets.index', $booking) }}" class="btn-submit" style="padding:6px 14px;font-size:12.5px;margin-top:6px;">
                <i class="bi bi-download"></i> E-Tiket
              </a>
            </div>
          </div>
        @empty
          <div class="empty-state">
            <i class="bi bi-ticket-detailed" style="font-size:32px;color:#9CA3AF;display:block;margin-bottom:8px;"></i>
            Belum ada perjalanan mendatang. <a href="{{ route('search.index') }}" style="color:var(--green-700);font-weight:700;">Cari tiket sekarang →</a>
          </div>
        @endforelse

        <div style="border-top:1px dashed #E5E7EB;margin:28px 0 20px;"></div>

        <div class="block-header">
          <h2 class="block-title" style="font-size:15px;">
            <i class="bi bi-clock-history"></i>
            <span>Riwayat Perjalanan Selesai</span>
          </h2>
          <p class="block-sub">Daftar perjalanan bus yang sudah selesai Anda lalui</p>
        </div>

        @forelse ($history as $booking)
          @php $passenger = $booking->passengers->first(); @endphp
          <div class="trip-row">
            <div class="trip-info">
              <span class="tag tag-amber">Selesai</span>
              <div>
                <div class="t">{{ $booking->schedule->operator->name }} · {{ $booking->code }}</div>
                <div class="p">
                  {{ $booking->schedule->route->originCity->name }} → {{ $booking->schedule->route->destinationCity->name }}
                  · {{ $booking->schedule->service_date->locale('id')->translatedFormat('d M Y') }}
                  · Kursi {{ $passenger?->seat_no ?? '—' }}
                </div>
              </div>
            </div>
            <div style="text-align:right;">
              <div class="muted" style="font-size:12px;font-weight:700;">{{ rp($booking->total) }}</div>
              <span class="tag tag-green" style="margin-top:4px;display:inline-block;">Lunas</span>
            </div>
          </div>
        @empty
          <div class="empty-state">Belum ada riwayat perjalanan sebelumnya.</div>
        @endforelse
      </section>

      <!-- Section 3: Metode Pembayaran -->
      <section class="profile-block" id="metode-pembayaran">
        <div class="block-header">
          <h2 class="block-title">
            <i class="bi bi-credit-card"></i>
            <span>Metode Pembayaran Tersedia</span>
          </h2>
          <p class="block-sub">Pilihan saluran pembayaran instan saat Anda memesan tiket bus.</p>
        </div>
        <div class="pay-grid">
          <div class="pay-card">
            <b><i class="bi bi-qr-code" style="color:var(--green-600);font-size:18px;"></i> QRIS Universal</b>
            <span>BCA, Mandiri, GoPay, OVO, ShopeePay — scan satu kode QR untuk semua aplikasi e-wallet & perbankan.</span>
          </div>
          <div class="pay-card">
            <b><i class="bi bi-bank" style="color:#0284C7;font-size:18px;"></i> Virtual Account</b>
            <span>BCA, BRI, Mandiri, BNI, Permata — pembayaran terverifikasi otomatis dalam beberapa detik.</span>
          </div>
          <div class="pay-card">
            <b><i class="bi bi-wallet2" style="color:#7C3AED;font-size:18px;"></i> E-Wallet Instan</b>
            <span>ShopeePay, DANA, GoPay — konfirmasi pembayaran langsung melalui aplikasi mobile Anda.</span>
          </div>
        </div>
      </section>

      <!-- Section 4: Keamanan Akun -->
      <section class="profile-block" id="keamanan">
        <div class="block-header">
          <h2 class="block-title">
            <i class="bi bi-shield-lock"></i>
            <span>Keamanan Akun &amp; Kata Sandi</span>
          </h2>
          <p class="block-sub">Perbarui kata sandi Anda secara berkala untuk menjaga akun dan riwayat perjalanan tetap aman.</p>
        </div>

        <form method="POST" action="{{ route('profile.password') }}">
          @csrf
          @method('PUT')
          <div class="field-row" style="grid-template-columns: repeat(3, 1fr);">
            <div class="field">
              <label>Kata Sandi Saat Ini</label>
              <input type="password" name="current_password" required placeholder="••••••••">
            </div>
            <div class="field">
              <label>Kata Sandi Baru</label>
              <input type="password" name="password" required placeholder="Minimal 8 karakter">
            </div>
            <div class="field">
              <label>Ulangi Kata Sandi Baru</label>
              <input type="password" name="password_confirmation" required placeholder="Ketik ulang kata sandi">
            </div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn-submit">
              <i class="bi bi-shield-check"></i> Perbarui Kata Sandi
            </button>
          </div>
        </form>
      </section>

    </main>

  </div>

</div>

<script>
  (function () {
    var navLinks = document.querySelectorAll('#profileNav .nav-item');
    navLinks.forEach(function (link) {
      link.addEventListener('click', function () {
        navLinks.forEach(function (l) { l.classList.remove('active'); });
        link.classList.add('active');
      });
    });
  })();
</script>
@endsection