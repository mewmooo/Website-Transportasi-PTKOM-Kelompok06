@extends('layouts.app')

@section('title', 'Syarat & Ketentuan — TiketBus')

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
    <h1>Syarat &amp; Ketentuan Layanan</h1>
    <p>Harap membaca syarat dan ketentuan berikut dengan saksama sebelum memesan tiket bus di TiketBus.</p>
  </div>
</div>

<div class="doc-wrap">
  <div class="doc-card">
    <div class="doc-updated">
      <i class="bi bi-clock-history"></i> Terakhir diperbarui: 28 Oktober 2026 | Berlaku untuk semua rute dan armada TiketBus
    </div>

    <!-- 1 -->
    <div class="doc-section">
      <h2><span class="num">1</span> Ketentuan Umum &amp; Definisi</h2>
      <p>
        Selamat datang di <strong>TiketBus</strong>. Layanan ini dioperasikan untuk mempermudah calon penumpang melakukan reservasi tiket bus antarkota antarprovinsi (AKAP) dan pariwisata secara daring.
      </p>
      <ul>
        <li><strong>"Pengguna/Penumpang"</strong> adalah setiap individu yang mengakses platform dan/atau membeli tiket perjalanan.</li>
        <li><strong>"E-Tiket"</strong> adalah tanda bukti sah pemesanan yang diterbitkan oleh sistem TiketBus dengan kode pemesanan resmi dan kode QR.</li>
        <li><strong>"Operator Bus"</strong> adalah penyedia armada transportasi bus resmi yang bekerja sama dengan TiketBus.</li>
      </ul>
    </div>

    <!-- 2 -->
    <div class="doc-section">
      <h2><span class="num">2</span> Pemesanan Tiket &amp; Keaslian Identitas</h2>
      <p>
        Saat melakukan reservasi tiket, pengguna diwajibkan memberikan data identitas diri yang benar, sah, dan sesuai dengan dokumen resmi kependudukan (KTP / SIM / Paspor):
      </p>
      <ul>
        <li>Nama penumpang yang tertera pada E-Tiket harus cocok dengan kartu identitas yang ditunjukkan saat pemeriksaan boarding di terminal.</li>
        <li>Pengguna bertanggung jawab penuh atas kebenaran alamat email Google (@gmail.com) dan nomor kontak yang dimasukkan saat pemesanan.</li>
        <li>Satu tiket berlaku untuk satu orang penumpang pada satu nomor kursi yang telah dipilih.</li>
      </ul>
    </div>

    <!-- 3 -->
    <div class="doc-section">
      <h2><span class="num">3</span> Tarif, Pembayaran &amp; Batas Waktu</h2>
      <p>
        Semua tarif yang tertera di platform TiketBus adalah harga resmi dalam Rupiah (IDR) dan sudah termasuk premi asuransi perjalanan resmi (Jasa Raharja):
      </p>
      <ul>
        <li>Pembayaran wajib diselesaikan dalam jangka waktu maksimal <strong>1 x 24 jam</strong> sejak kode pemesanan diterbitkan.</li>
        <li>TiketBus berhak membatalkan pesanan secara otomatis apabila pembayaran tidak terkonfirmasi hingga batas waktu berakhir. Kursi yang dipesan akan otomatis dibuka kembali untuk penumpang lain.</li>
        <li>Metode pembayaran resmi meliputi Transfer Bank (BCA, Mandiri, BNI, BRI) dan E-Wallet terverifikasi.</li>
      </ul>
    </div>

    <!-- 4 -->
    <div class="doc-section">
      <h2><span class="num">4</span> Prosedur Boarding &amp; Keberangkatan</h2>
      <ul>
        <li>Penumpang wajib tiba di titik kumpul terminal atau agen keberangkatan minimal <strong>30 menit sebelum jadwal bus berangkat</strong>.</li>
        <li>Penumpang wajib menunjukkan E-Tiket resmi (format PDF / layar smartphone) beserta Kartu Identitas asli kepada petugas armada sebelum memasuki kabin bus.</li>
        <li>Keterlambatan penumpang yang mengakibatkan tertinggalnya bus di luar tanggung jawab pihak TiketBus dan tiket dinyatakan hangus.</li>
      </ul>
    </div>

    <!-- 5 -->
    <div class="doc-section">
      <h2><span class="num">5</span> Kebijakan Bagasi &amp; Barang Bawaan</h2>
      <ul>
        <li>Setiap penumpang berhak membawa bagasi cuma-cuma dengan berat maksimal <strong>20 kg</strong>.</li>
        <li>Dilarang keras membawa barang terlarang, senjata tajam, zat kimia mudah meledak/terbakar, narkotika, serta hewan peliharaan jenis apa pun ke dalam kabin maupun bagasi bus.</li>
        <li>Penyedia bus berhak menolak mengangkut bagasi yang melanggar ketentuan hukum Republik Indonesia.</li>
      </ul>
    </div>

    <!-- 6 -->
    <div class="doc-section">
      <h2><span class="num">6</span> Perubahan Jadwal (Reschedule) &amp; Pembatalan (Refund)</h2>
      <ul>
        <li>Pengajuan perubahan tanggal/jam keberangkatan (Reschedule) dapat diproses maksimal <strong>6 jam sebelum bus berangkat</strong> melalui menu bantuan atau posko resmi.</li>
        <li>Pembatalan tiket (Refund) tunduk pada kebijakan masing-masing operator PO Bus dan dapat dikenakan biaya administrasi pembatalan.</li>
        <li>Tiket yang telah lewat dari jadwal keberangkatan bus (status <em>Departed</em> / <em>Completed</em>) tidak dapat di-reschedule maupun di-refund.</li>
      </ul>
    </div>

    <!-- 7 -->
    <div class="doc-section">
      <h2><span class="num">7</span> Keadaan Kahar (Force Majeure)</h2>
      <p>
        TiketBus dan Operator Bus dibebaskan dari tuntutan ganti rugi apabila terjadi keterlambatan atau pembatalan perjalanan yang disebabkan oleh keadaan di luar kendali manusia (bencana alam, penutupan jalan tol mendadak oleh kepolisian, kerusakan teknis darurat, atau kerusuhan massal).
      </p>
    </div>

    <!-- CTA -->
    <div class="doc-cta">
      <h3>Punya Pertanyaan Mengenai Ketentuan Ini?</h3>
      <p>Tim Customer Service kami siap melayani dan memberikan penjelasan lebih rinci untuk perjalanan Anda.</p>
      <a href="{{ route('help') }}" class="btn btn-primary" style="display:inline-block;">
        <i class="bi bi-question-circle"></i> Kunjungi Pusat Bantuan
      </a>
    </div>
  </div>
</div>
@endsection

