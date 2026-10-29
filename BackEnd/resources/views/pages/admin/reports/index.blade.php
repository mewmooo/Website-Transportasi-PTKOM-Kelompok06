@extends('layouts.admin')

@section('title', 'Laporan & Bantuan Pengguna — Admin TiketBus')

@section('content')
<div class="admin-top">
  <div>
    <h1 class="page-h">Laporan &amp; Bantuan Pengguna</h1>
    <div class="page-sub">Kelola pesan, pertanyaan, dan keluhan yang dikirimkan pengguna melalui formulir bantuan</div>
  </div>
  <div style="display:flex;align-items:center;gap:12px;">
    <a href="{{ route('help') }}" target="_blank" class="btn-outline"><i class="bi bi-box-arrow-up-right"></i> Buka Halaman Bantuan</a>
  </div>
</div>

<div class="kpi-grid">
  <div class="card kpi">
    <div class="lbl">Total Laporan <span><i class="bi bi-journal-text" style="color:var(--green-600);font-size:18px;"></i></span></div>
    <div class="val">{{ $stats['total'] }}</div>
    <div class="sub">Semua pesan yang masuk</div>
  </div>
  <div class="card kpi">
    <div class="lbl">Menunggu Review <span><i class="bi bi-hourglass-split" style="color:#D97706;font-size:18px;"></i></span></div>
    <div class="val" style="color:#D97706;">{{ $stats['pending'] }}</div>
    <div class="sub">Belum diproses admin</div>
  </div>
  <div class="card kpi">
    <div class="lbl">Sedang Diproses <span><i class="bi bi-arrow-repeat" style="color:var(--green-600);font-size:18px;"></i></span></div>
    <div class="val" style="color:var(--green-600);">{{ $stats['in_progress'] }}</div>
    <div class="sub">Dalam tindak lanjut</div>
  </div>
  <div class="card kpi">
    <div class="lbl">Terselesaikan <span><i class="bi bi-check2-circle" style="color:#059669;font-size:18px;"></i></span></div>
    <div class="val" style="color:#059669;">{{ $stats['resolved'] }}</div>
    <div class="sub">Sudah ditangani lengkap</div>
  </div>
</div>

<div class="card table-card">
  <div class="table-head">
    <div class="th-title">Daftar Tiket Bantuan ({{ $reports->total() }} Laporan)</div>
    <form class="table-filters" method="GET" action="{{ route('admin.reports.index') }}">
      <input type="text" name="q" value="{{ $filters['q'] }}" placeholder="Cari nama, email, kode..." style="width:200px;">
      
      <select name="status" onchange="this.form.submit()">
        <option value="">Semua Status</option>
        <option value="pending" @selected($filters['status'] === 'pending')>Menunggu Review</option>
        <option value="in_progress" @selected($filters['status'] === 'in_progress')>Sedang Diproses</option>
        <option value="resolved" @selected($filters['status'] === 'resolved')>Selesai</option>
        <option value="closed" @selected($filters['status'] === 'closed')>Ditutup</option>
      </select>

      <select name="category" onchange="this.form.submit()">
        <option value="">Semua Kategori</option>
        <option value="Pemesanan & Kursi" @selected($filters['category'] === 'Pemesanan & Kursi')>Pemesanan &amp; Kursi</option>
        <option value="Pembayaran & Konfirmasi" @selected($filters['category'] === 'Pembayaran & Konfirmasi')>Pembayaran &amp; Konfirmasi</option>
        <option value="E-Tiket & Boarding" @selected($filters['category'] === 'E-Tiket & Boarding')>E-Tiket &amp; Boarding</option>
        <option value="Reschedule & Refund" @selected($filters['category'] === 'Reschedule & Refund')>Reschedule &amp; Refund</option>
        <option value="Lainnya" @selected($filters['category'] === 'Lainnya')>Lainnya</option>
      </select>

      <a href="{{ route('admin.reports.index') }}" class="btn-outline"><i class="bi bi-arrow-clockwise"></i> Reset</a>
    </form>
  </div>

  <table>
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Pengirim</th>
        <th>Kategori</th>
        <th>Kode Booking</th>
        <th>Isi Pesan Singkat</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($reports as $report)
        <tr>
          <td style="white-space:nowrap;font-size:12.5px;color:var(--ink-soft);">
            {{ $report->created_at->format('d/m/Y H:i') }}
          </td>
          <td>
            <div style="font-weight:700;">{{ $report->name }}</div>
            <div style="font-size:12px;color:var(--ink-soft);">{{ $report->email }}</div>
          </td>
          <td>
            <span style="font-weight:600;font-size:12px;color:var(--green-700);background:var(--green-50);padding:3px 8px;border-radius:6px;">
              {{ $report->category }}
            </span>
          </td>
          <td>
            @if ($report->booking_code)
              <code style="background:#F3F4F6;padding:3px 6px;border-radius:4px;font-size:11.5px;font-weight:700;">{{ $report->booking_code }}</code>
            @else
              <span style="color:var(--ink-soft);font-size:12px;">-</span>
            @endif
          </td>
          <td style="max-width:280px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
            {{ \Illuminate\Support\Str::limit($report->message, 50) }}
          </td>
          <td>
            <span class="status-pill {{ $report->statusClass() }}">
              {{ $report->statusLabel() }}
            </span>
          </td>
          <td>
            <a href="{{ route('admin.reports.show', $report) }}" class="btn-outline" style="padding:5px 12px;font-size:12px;">
              <i class="bi bi-search"></i> Review
            </a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" style="text-align:center;padding:36px;color:var(--ink-soft);">
            Tidak ada laporan bantuan yang cocok dengan kriteria filter.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div class="table-foot" style="display:flex;justify-content:space-between;align-items:center;margin-top:18px;">
    <div>Halaman {{ $reports->currentPage() }} dari {{ $reports->lastPage() }}</div>
    {{ $reports->links('partials.pagination') }}
  </div>
</div>
@endsection
