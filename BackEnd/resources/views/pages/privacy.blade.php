@extends('layouts.app')

@section('title', 'Kebijakan Privasi — TiketBus')

@section('content')
<style>
  .doc-hero {
    background: linear-gradient(135deg, var(--green-900) 0%, var(--green-700) 100%);
    color: #fff;
    padding: 48px 24px 54px;
    text-align: center;
  }
  .doc-hero h1 {
    font-size: 32px;
    font-weight: 800;
    margin: 0 0 10px;
    letter-spacing: -0.01em;
  }
  .doc-hero p {
    margin: 0;
    color: #D1FAE5;
    font-size: 15px;
  }
  .doc-wrap {
    max-width: 860px;
    margin: -24px auto 64px;
    padding: 0 20px;
  }
  .doc-card {
    background: var(--white);
    border: 1px solid var(--line);
    border-radius: var(--radius);
    padding: 40px 48px;
    box-shadow: var(--shadow);
  }
  .doc-updated {
    font-size: 13px;
    color: var(--ink-soft);
    margin-bottom: 28px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--line-soft);
  }
  .doc-section {
    margin-bottom: 32px;
  }
  .doc-section h2 {
    font-size: 18px;
    font-weight: 800;
    color: var(--green-900);
    margin: 0 0 12px;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .doc-section h2 span.num {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 8px;
    background: var(--green-100);
    color: var(--green-700);
    font-size: 14px;
  }
  .doc-section p, .doc-section li {
    font-size: 14.5px;
    color: #374151;
    line-height: 1.7;
    margin: 0 0 10px;
  }
  .doc-section ul, .doc-section ol {
    margin: 8px 0 16px 20px;
    padding: 0;
  }
  .doc-cta {
    background: var(--green-50);
    border: 1px dashed var(--green-600);
    border-radius: 12px;
    padding: 24px;
    text-align: center;
    margin-top: 40px;
  }
  .doc-cta h3 {
    margin: 0 0 6px;
    font-size: 17px;
    color: var(--green-900);
  }
  .doc-cta p {
    margin: 0 0 16px;
    font-size: 13.5px;
    color: var(--ink-soft);
  }
  @media(max-width: 640px) {
    .doc-card { padding: 24px 20px; }
    .doc-hero h1 { font-size: 24px; }
  }
</style>

<div class="doc-hero">
  <div class="container">
    <h1>Kebijakan Privasi</h1>
    <p>Bagaimana TiketBus mengumpulkan, mengelola, dan melindungi data pribadi penumpang secara aman.</p>
  </div>
</div>

<div class="doc-wrap">
  <div class="doc-card">
    <div class="doc-updated">
      <i class="bi bi-shield-check"></i> Kebijakan Privasi TiketBus | Diperbarui: 28 Oktober 2026 | Memenuhi UU Perlindungan Data Pribadi
    </div>

    <!-- 1 -->
    <div class="doc-section">
      <h2><span class="num">1</span> Komitmen Perlindungan Privasi</h2>
      <p>
        <strong>TiketBus</strong> berkomitmen penuh untuk menghormati dan melindungi hak privasi setiap pengguna. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, serta menjaga kerahasiaan informasi pribadi Anda saat menggunakan platform web TiketBus.
      </p>
    </div>

    <!-- 2 -->
    <div class="doc-section">
      <h2><span class="num">2</span> Data Pribadi yang Kami Kumpulkan</h2>
      <p>Kami mengumpulkan data berikut yang diberikan secara sukarela oleh pengguna saat pendaftaran akun atau pemesanan tiket:</p>
      <ul>
        <li><strong>Informasi Kontak Akun:</strong> Nama lengkap, alamat email Google (@gmail.com), dan nomor telepon/WhatsApp.</li>
        <li><strong>Data Penumpang:</strong> Nama penumpang yang tertera pada tiket dan nomor identitas kependudukan untuk manifes perjalanan bus.</li>
        <li><strong>Rincian Transaksi:</strong> Riwayat pemesanan tiket, nomor kursi yang dipilih, rute perjalanan, status pembayaran, serta metode pembayaran yang dipilih.</li>
      </ul>
    </div>

    <!-- 3 -->
    <div class="doc-section">
      <h2><span class="num">3</span> Tujuan Penggunaan Data Pribadi</h2>
      <p>Informasi yang kami kumpulkan digunakan semata-mata untuk keperluan operasional layanan perjalanan, antara lain:</p>
      <ul>
        <li>Menerbitkan E-Tiket resmi yang sah dan mengirimkannya ke akun serta email pengguna.</li>
        <li>Mengirimkan notifikasi pembayaran, pengingat jadwal keberangkatan, dan tautan pemulihan kata sandi.</li>
        <li>Memverifikasi identitas penumpang saat proses boarding di terminal oleh petugas resmi.</li>
        <li>Memberikan bantuan cepat melalui tim Customer Support apabila terjadi kendala operasional.</li>
      </ul>
    </div>

    <!-- 4 -->
    <div class="doc-section">
      <h2><span class="num">4</span> Keamanan &amp; Enkripsi Data</h2>
      <p>Kami menerapkan standar keamanan siber mutakhir untuk melindungi data Anda dari akses tanpa izin, perusakan, atau kebocoran:</p>
      <ul>
        <li><strong>Enkripsi Kata Sandi:</strong> Semua kata sandi akun dienkripsi menggunakan algoritma *Bcrypt* satu arah yang tidak dapat dibaca oleh pihak mana pun, termasuk administrator kami.</li>
        <li><strong>Perlindungan Token CSRF:</strong> Setiap pengiriman formulir dilindungi token keamanan anti-pemalsuan lintas situs.</li>
        <li><strong>Koneksi Terenkripsi:</strong> Seluruh pertukaran data antar pengguna dan server dilindungi protokol SSL/TLS (HTTPS).</li>
      </ul>
    </div>

    <!-- 5 -->
    <div class="doc-section">
      <h2><span class="num">5</span> Pembagian Data dengan Pihak Ketiga</h2>
      <p>
        <strong>TiketBus tidak pernah dan tidak akan pernah menjual, menyewakan, atau menyebarluaskan data pribadi Anda</strong> kepada pihak ketiga mana pun untuk kepentingan pemasaran/iklan. Data penumpang hanya dibagikan secara terbatas kepada:
      </p>
      <ul>
        <li><strong>Operator Bus Terkait:</strong> Nama penumpang dan nomor kursi dibagikan kepada kru bus untuk keperluan manifes penumpang dan pemeriksaan di terminal.</li>
        <li><strong>Badan Asuransi Resmi:</strong> Data penumpang diikutsertakan pada klaim asuransi perjalanan perlindungan kecelakaan resmi.</li>
      </ul>
    </div>

    <!-- 6 -->
    <div class="doc-section">
      <h2><span class="num">6</span> Hak Pengguna atas Data Pribadi</h2>
      <p>Sebagai pengguna, Anda memiliki kendali penuh atas data pribadi Anda:</p>
      <ul>
        <li>Anda dapat mengakses, memperbarui nama, dan mengganti nomor telepon Anda kapan saja melalui menu <strong>Profil Akun</strong>.</li>
        <li>Anda berhak meminta penghapusan akun dan riwayat perjalanan Anda dengan menghubungi tim bantuan kami.</li>
      </ul>
    </div>

    <!-- CTA -->
    <div class="doc-cta">
      <h3>Ada Pertanyaan Terkait Privasi Anda?</h3>
      <p>Silakan hubungi tim keamanan dan layanan pelanggan TiketBus jika memiliki pertanyaan mengenai kebijakan ini.</p>
      <a href="{{ route('help') }}#kontak" class="btn btn-primary" style="display:inline-block;">
        <i class="bi bi-chat-dots"></i> Hubungi Customer Service
      </a>
    </div>
  </div>
</div>
@endsection

