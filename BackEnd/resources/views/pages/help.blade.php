@extends('layouts.app')

@section('title', 'Pusat Bantuan & Layanan Pelanggan — TiketBus')

@section('content')
<style>
  .help-hero {
    background: linear-gradient(135deg, var(--green-900) 0%, var(--green-700) 100%);
    color: #fff;
    padding: 56px 24px 64px;
    text-align: center;
    position: relative;
    overflow: hidden;
  }
  .help-hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 80% 20%, rgba(31,168,114,0.2) 0%, transparent 60%);
    pointer-events: none;
  }
  .help-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 14px;
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.25);
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
    color: #D1FAE5;
    margin-bottom: 16px;
    backdrop-filter: blur(4px);
  }
  .help-hero h1 {
    font-size: 36px;
    font-weight: 800;
    margin: 0 0 12px;
    letter-spacing: -0.02em;
  }
  .help-hero p {
    font-size: 16px;
    color: #D1FAE5;
    max-width: 600px;
    margin: 0 auto 28px;
    line-height: 1.6;
  }
  .help-search-box {
    max-width: 580px;
    margin: 0 auto;
    position: relative;
  }
  .help-search-input {
    width: 100%;
    padding: 16px 20px 16px 50px;
    border-radius: 14px;
    border: none;
    font-size: 15px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    outline: none;
  }
  .help-search-icon {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 18px;
    color: var(--ink-soft);
  }

  .help-content-wrap {
    padding: 48px 0 64px;
  }

  .topic-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    margin-bottom: 48px;
  }
  .topic-card {
    background: var(--white);
    border: 1px solid var(--line);
    border-radius: var(--radius);
    padding: 24px;
    box-shadow: var(--shadow);
    transition: transform .2s, border-color .2s, box-shadow .2s;
    cursor: pointer;
  }
  .topic-card:hover {
    transform: translateY(-4px);
    border-color: var(--green-500);
    box-shadow: 0 12px 28px -8px rgba(15, 61, 46, 0.15);
  }
  .topic-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: var(--green-50);
    color: var(--green-700);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    margin-bottom: 16px;
  }
  .topic-card h3 {
    margin: 0 0 6px;
    font-size: 17px;
    font-weight: 700;
    color: var(--ink);
  }
  .topic-card p {
    margin: 0;
    font-size: 13.5px;
    color: var(--ink-soft);
    line-height: 1.5;
  }

  /* FAQ Accordion */
  .section-heading {
    margin-bottom: 24px;
  }
  .section-heading h2 {
    font-size: 24px;
    font-weight: 800;
    margin: 0 0 6px;
    color: var(--ink);
  }
  .section-heading p {
    margin: 0;
    font-size: 14.5px;
    color: var(--ink-soft);
  }

  .faq-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 56px;
  }
  .faq-item {
    background: var(--white);
    border: 1px solid var(--line);
    border-radius: var(--radius);
    overflow: hidden;
    transition: border-color .2s;
  }
  .faq-item.active {
    border-color: var(--green-600);
  }
  .faq-question {
    width: 100%;
    padding: 20px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: none;
    border: none;
    text-align: left;
    font-size: 16px;
    font-weight: 700;
    color: var(--ink);
    cursor: pointer;
  }
  .faq-question:hover {
    color: var(--green-700);
  }
  .faq-icon {
    font-size: 18px;
    color: var(--green-700);
    transition: transform .25s ease;
  }
  .faq-item.active .faq-icon {
    transform: rotate(180deg);
  }
  .faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height .3s ease, padding .3s ease;
    padding: 0 24px;
    font-size: 14.5px;
    color: var(--ink-soft);
    line-height: 1.65;
    background: #FCFDFD;
  }
  .faq-item.active .faq-answer {
    max-height: 350px;
    padding: 0 24px 22px;
    border-top: 1px dashed var(--line-soft);
  }

  /* Contact Channels */
  .contact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 56px;
  }
  .contact-card {
    background: var(--white);
    border: 1px solid var(--line);
    border-radius: var(--radius);
    padding: 28px 24px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 12px;
  }
  .contact-card .badge-status {
    font-size: 11.5px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 6px;
    background: #DCFCE7;
    color: #166534;
  }
  .contact-card h4 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: var(--ink);
  }
  .contact-card p {
    margin: 0;
    font-size: 13.5px;
    color: var(--ink-soft);
  }
  .contact-card a.action-btn {
    margin-top: 6px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    font-weight: 700;
    color: var(--green-700);
    border: 1px solid var(--green-700);
    padding: 8px 16px;
    border-radius: 8px;
    transition: all .15s;
  }
  .contact-card a.action-btn:hover {
    background: var(--green-700);
    color: #fff;
  }

  /* Support Form Box */
  .help-form-card {
    background: var(--white);
    border: 1px solid var(--line);
    border-radius: 16px;
    padding: 36px 32px;
    box-shadow: var(--shadow);
    margin-bottom: 48px;
  }
  .help-form-card h3 {
    margin: 0 0 8px;
    font-size: 20px;
    font-weight: 800;
    color: var(--ink);
  }
  .help-form-card p.sub {
    margin: 0 0 24px;
    font-size: 14px;
    color: var(--ink-soft);
  }
  .form-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }
  .form-group {
    margin-bottom: 16px;
  }
  .form-group label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 6px;
    color: var(--ink);
  }
  .form-group input, .form-group select, .form-group textarea {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid var(--line);
    border-radius: 8px;
    font-size: 14px;
    color: var(--ink);
    background: #FAFBF9;
    transition: border-color .15s, background .15s;
  }
  .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
    border-color: var(--green-600);
    background: #fff;
  }
  .btn-submit-help {
    background: var(--green-700);
    color: #fff;
    border: none;
    font-weight: 700;
    font-size: 14.5px;
    padding: 12px 24px;
    border-radius: 8px;
    transition: background .15s;
  }
  .btn-submit-help:hover {
    background: var(--green-600);
  }

  /* Info policy block */
  .info-policy-box {
    background: var(--green-50);
    border: 1px solid #D1E7DD;
    border-radius: 12px;
    padding: 24px;
    font-size: 13.5px;
    color: #14532D;
    line-height: 1.6;
  }
  .info-policy-box strong {
    font-size: 14.5px;
    display: block;
    margin-bottom: 6px;
  }

  @media (max-width: 768px) {
    .help-hero h1 { font-size: 26px; }
    .form-grid-2 { grid-template-columns: 1fr; }
    .help-form-card { padding: 24px 20px; }
  }
</style>

<div class="help-hero">
  <div class="help-badge">
    <i class="bi bi-shield-check"></i> Layanan Bantuan Resmi TiketBus
  </div>
  <h1>Bagaimana kami dapat membantu Anda hari ini?</h1>
  <p>Temukan jawaban instan seputar reservasi tiket, pembayaran online, jadwal keberangkatan bus, dan e-tiket.</p>

  <div class="help-search-box">
    <i class="bi bi-search help-search-icon"></i>
    <input type="text" id="helpSearch" class="help-search-input" placeholder="Ketik pertanyaan atau kata kunci (contoh: tiket, refund, bayar)...">
  </div>
</div>

<div class="container help-content-wrap">

  <!-- 4 Topic Cards -->
  <div class="topic-grid">
    <div class="topic-card" onclick="filterFaq('pemesanan')">
      <div class="topic-icon"><i class="bi bi-ticket-perforated"></i></div>
      <h3>Pemesanan &amp; Kursi</h3>
      <p>Panduan memilih nomor kursi bus dan mengisi identitas penumpang.</p>
    </div>
    <div class="topic-card" onclick="filterFaq('pembayaran')">
      <div class="topic-icon"><i class="bi bi-credit-card"></i></div>
      <h3>Pembayaran &amp; Batas Waktu</h3>
      <p>Instruksi metode transfer bank, e-wallet, serta konfirmasi status lunas.</p>
    </div>
    <div class="topic-card" onclick="filterFaq('boarding')">
      <div class="topic-icon"><i class="bi bi-qr-code-scan"></i></div>
      <h3>E-Tiket &amp; Naik Bus</h3>
      <p>Cara mengunduh e-tiket PDF dan prosedur check-in di terminal.</p>
    </div>
    <div class="topic-card" onclick="filterFaq('refund')">
      <div class="topic-icon"><i class="bi bi-arrow-repeat"></i></div>
      <h3>Reschedule &amp; Refund</h3>
      <p>Ketentuan pengubahan jadwal dan kebijakan pengembalian tiket.</p>
    </div>
  </div>

  <!-- FAQ Section -->
  <div class="section-heading">
    <h2>Pertanyaan yang Sering Diajukan (FAQ)</h2>
    <p>Jawaban cepat untuk pertanyaan yang paling sering ditanyakan pelanggan.</p>
  </div>

  <div class="faq-list" id="faqList">
    <!-- Q1 -->
    <div class="faq-item active" data-keywords="pesan memesan beli tiket kursi rute jadwal cara">
      <button type="button" class="faq-question" onclick="toggleFaq(this)">
        <span>Bagaimana cara memesan tiket bus di aplikasi TiketBus?</span>
        <i class="bi bi-chevron-down faq-icon"></i>
      </button>
      <div class="faq-answer">
        1. Buka menu <strong>Cari Tiket</strong>.<br>
        2. Pilih kota asal, kota tujuan, dan tanggal keberangkatan yang diinginkan.<br>
        3. Klik pada jadwal bus yang tersedia untuk melihat denah armada.<br>
        4. Pilih nomor kursi bus yang masih kosong (berwarna hijau).<br>
        5. Lengkapi formulir identitas penumpang dan selesaikan pembayaran sebelum batas waktu berakhir.
      </div>
    </div>

    <!-- Q2 -->
    <div class="faq-item" data-keywords="pembayaran bayar batas waktu rekening transfer konfirmasi lunas">
      <button type="button" class="faq-question" onclick="toggleFaq(this)">
        <span>Berapa lama batas waktu pembayaran setelah reservasi kursi?</span>
        <i class="bi bi-chevron-down faq-icon"></i>
      </button>
      <div class="faq-answer">
        Setiap pemesanan diberikan batas waktu pembayaran maksimal <strong>1 x 24 jam</strong> sejak kode pemesanan diterbitkan. Jika tidak diselesaikan dalam batas waktu tersebut, sistem secara otomatis akan membatalkan reservasi dan kursi akan kembali tersedia untuk penumpang lain.
      </div>
    </div>

    <!-- Q3 -->
    <div class="faq-item" data-keywords="e-tiket cetak unduh tiket hilang boarding barcode qr code pdf">
      <button type="button" class="faq-question" onclick="toggleFaq(this)">
        <span>Di mana saya bisa melihat dan mengunduh E-Tiket saya?</span>
        <i class="bi bi-chevron-down faq-icon"></i>
      </button>
      <div class="faq-answer">
        Setelah pembayaran terverifikasi, E-Tiket resmi dapat langsung diakses melalui menu <strong>Cek Pesanan</strong> di akun Anda. Anda bisa mencetak atau menyimpan E-Tiket dalam format PDF yang dilengkapi QR Code resmi untuk ditunjukkan kepada petugas boarding saat di terminal bus.
      </div>
    </div>

    <!-- Q4 -->
    <div class="faq-item" data-keywords="syarat naik bus identitas ktp boarding terminal barang bagasi">
      <button type="button" class="faq-question" onclick="toggleFaq(this)">
        <span>Apa saja dokumen yang wajib dibawa saat naik bus (Boarding)?</span>
        <i class="bi bi-chevron-down faq-icon"></i>
      </button>
      <div class="faq-answer">
        Anda cukup menyiapkan:<br>
        • <strong>E-Tiket TiketBus</strong> (bisa dalam bentuk digital di layar HP atau cetakan kertas).<br>
        • <strong>Kartu Identitas Asli</strong> (KTP/SIM/Paspor) yang namanya sesuai dengan identitas penumpang yang didaftarkan.<br>
        Disarankan untuk tiba di titik keberangkatan minimal <strong>30 menit sebelum bus dijadwalkan berangkat</strong>.
      </div>
    </div>

    <!-- Q5 -->
    <div class="faq-item" data-keywords="reschedule ubah jadwal ganti tanggal ganti jam pembatalan refund">
      <button type="button" class="faq-question" onclick="toggleFaq(this)">
        <span>Apakah tiket yang sudah dibeli bisa diubah jadwal (Reschedule) atau dibatalkan?</span>
        <i class="bi bi-chevron-down faq-icon"></i>
      </button>
      <div class="faq-answer">
        Perubahan jadwal dapat diajukan maksimal <strong>6 jam sebelum keberangkatan</strong> dengan menghubungi layanan pelanggan kami atau agen resmi di terminal. Tiket yang sudah melewati waktu keberangkatan dinyatakan hangus dan tidak dapat dikembalikan.
      </div>
    </div>

    <!-- Q6 -->
    <div class="faq-item" data-keywords="reset kata sandi lupa password gmail akun masuk">
      <button type="button" class="faq-question" onclick="toggleFaq(this)">
        <span>Bagaimana jika saya lupa kata sandi akun TiketBus saya?</span>
        <i class="bi bi-chevron-down faq-icon"></i>
      </button>
      <div class="faq-answer">
        Klik menu <strong>Lupa kata sandi?</strong> di halaman login, masukkan email Google (@gmail.com) yang Anda gunakan saat mendaftar. Tautan pemulihan kata sandi akan langsung dikirimkan ke kotak masuk email Anda untuk membuat sandi baru secara aman.
      </div>
    </div>
  </div>

  <!-- Contact Channels Grid -->
  <div class="section-heading" id="kontak">
    <h2>Hubungi Layanan Pelanggan</h2>
    <p>Tim Customer Support kami siap membantu kendala Anda 24 jam sehari, 7 hari seminggu.</p>
  </div>

  <div class="contact-grid">
    <div class="contact-card">
      <span class="badge-status">● Siaga 24 Jam</span>
      <div style="font-size:26px;color:var(--green-600);"><i class="bi bi-whatsapp"></i></div>
      <h4>WhatsApp Support</h4>
      <p>Respon instan untuk kendala tiket mendesak dan konfirmasi boarding.</p>
      <a href="https://wa.me/6281234567890?text=Halo%20TiketBus,%20saya%20membutuhkan%20bantuan%20terkait%20tiket%20saya" target="_blank" class="action-btn">
        <i class="bi bi-chat-dots"></i> Chat WhatsApp
      </a>
    </div>

    <div class="contact-card">
      <span class="badge-status">● Respon &lt; 2 Jam</span>
      <div style="font-size:26px;color:var(--green-600);"><i class="bi bi-envelope-at"></i></div>
      <h4>Email Dukungan</h4>
      <p>Kirimkan bukti pembayaran atau pertanyaan detail seputar layanan.</p>
      <a href="mailto:support@tiketbus.com?subject=Bantuan%20Pemesanan%20TiketBus" class="action-btn">
        <i class="bi bi-send"></i> Kirim Email
      </a>
    </div>

    <div class="contact-card">
      <span class="badge-status">● Posko Terminal</span>
      <div style="font-size:26px;color:var(--green-600);"><i class="bi bi-geo-alt"></i></div>
      <h4>Kantor Layanan Terminal</h4>
      <p>Layanan operasional tiket dan loket resmi di Terminal Terpadu Pulo Gebang.</p>
      <a href="#form-bantuan" class="action-btn">
        <i class="bi bi-pencil-square"></i> Buat Laporan
      </a>
    </div>
  </div>

  <!-- Interactive Contact Form -->
  <div class="help-form-card" id="form-bantuan">
    <h3>Kirim Pesan Bantuan Langsung</h3>
    <p class="sub">Punya keluhan, pertanyaan khusus, atau kendala tiket? Isi formulir di bawah ini dan tim TiketBus akan segera merespon.</p>

    <form method="POST" action="{{ route('help.submit') }}">
      @csrf
      <div class="form-grid-2">
        <div class="form-group">
          <label for="name">Nama Lengkap</label>
          <input type="text" id="name" name="name" value="{{ auth()->check() ? auth()->user()->name : old('name') }}" placeholder="Contoh: Budi Santoso" required>
        </div>
        <div class="form-group">
          <label for="email">Alamat Email</label>
          <input type="email" id="email" name="email" value="{{ auth()->check() ? auth()->user()->email : old('email') }}" placeholder="nama@gmail.com" required>
        </div>
      </div>

      <div class="form-grid-2">
        <div class="form-group">
          <label for="phone">Nomor Telepon / WhatsApp</label>
          <input type="tel" id="phone" name="phone" value="{{ auth()->check() ? auth()->user()->phone : old('phone') }}" placeholder="081234567890">
        </div>
        <div class="form-group">
          <label for="category">Kategori Masalah</label>
          <select id="category" name="category" required>
            <option value="Pemesanan & Kursi">Pemesanan &amp; Pemilihan Kursi</option>
            <option value="Pembayaran & Konfirmasi">Kendala Pembayaran / Konfirmasi Bank</option>
            <option value="E-Tiket & Boarding">E-Tiket Hilang / Masalah Boarding</option>
            <option value="Reschedule & Refund">Pengajuan Reschedule / Refund</option>
            <option value="Lainnya">Pertanyaan Umum Lainnya</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="booking_code">Kode Pemesanan (Opsional)</label>
        <input type="text" id="booking_code" name="booking_code" placeholder="Contoh: BK-20261028-XXXX (jika ada)">
      </div>

      <div class="form-group">
        <label for="message">Rincian Pertanyaan / Kendala</label>
        <textarea id="message" name="message" rows="4" placeholder="Jelaskan pertanyaan atau kendala yang Anda alami secara detail..." required></textarea>
      </div>

      <button type="submit" class="btn-submit-help">
        <i class="bi bi-send-check"></i> Kirim Pesan Bantuan
      </button>
    </form>
  </div>

  <!-- Syarat & Ketentuan / Kebijakan Ringkas -->
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:32px;" class="policy-links-grid">
    <div class="info-policy-box" id="syarat">
      <strong>📋 Ketentuan Umum &amp; Keamanan Penumpang</strong>
      <p style="margin:6px 0 14px;">Setiap penumpang wajib memiliki tiket yang sah dan identitas yang sesuai. Bagasi maksimal adalah 20 kg per penumpang. TiketBus berkomitmen memberikan perjalanan antar kota yang aman, nyaman, dan terpercaya.</p>
      <a href="{{ route('terms') }}" style="color:var(--green-700);font-weight:700;display:inline-flex;align-items:center;gap:6px;">
        Baca Syarat &amp; Ketentuan Lengkap <i class="bi bi-arrow-right"></i>
      </a>
    </div>

    <div class="info-policy-box" id="privasi">
      <strong>🔒 Kebijakan Privasi &amp; Perlindungan Data</strong>
      <p style="margin:6px 0 14px;">Kami melindungi data pribadi (nama, nomor telepon, dan email Google) penumpang dengan enkripsi keamanan tinggi. Data Anda hanya digunakan untuk verifikasi e-tiket dan konfirmasi pemesanan.</p>
      <a href="{{ route('privacy') }}" style="color:var(--green-700);font-weight:700;display:inline-flex;align-items:center;gap:6px;">
        Baca Kebijakan Privasi Lengkap <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>

</div>

<script>
  function toggleFaq(btn) {
    const item = btn.closest('.faq-item');
    const isActive = item.classList.contains('active');
    
    // Tutup yang lain agar rapi
    document.querySelectorAll('.faq-item').forEach(el => el.classList.remove('active'));
    
    if (!isActive) {
      item.classList.add('active');
    }
  }

  function filterFaq(category) {
    const input = document.getElementById('helpSearch');
    input.value = category;
    applySearch(category);
    document.getElementById('faqList').scrollIntoView({ behavior: 'smooth' });
  }

  const searchInput = document.getElementById('helpSearch');
  searchInput.addEventListener('input', function() {
    applySearch(this.value.toLowerCase().trim());
  });

  function applySearch(query) {
    const items = document.querySelectorAll('.faq-item');
    let hasMatch = false;

    items.forEach(item => {
      const keywords = item.getAttribute('data-keywords') || '';
      const text = item.textContent.toLowerCase();

      if (query === '' || keywords.includes(query) || text.includes(query)) {
        item.style.display = 'block';
        hasMatch = true;
      } else {
        item.style.display = 'none';
      }
    });
  }
</script>
@endsection

