@extends('layouts.admin')

@section('title', 'Review Laporan #' . $report->id . ' — Admin TiketBus')

@section('content')
<div class="admin-top">
  <div>
    <a href="{{ route('admin.reports.index') }}" class="btn-outline" style="margin-bottom:10px;"><i class="bi bi-arrow-left"></i> Kembali ke Daftar Laporan</a>
    <h1 class="page-h">Review Laporan Bantuan #{{ $report->id }}</h1>
    <div class="page-sub">Diterima pada {{ $report->created_at->locale('id')->translatedFormat('d F Y, H:i') }} WIB</div>
  </div>
  <div>
    <span class="status-pill {{ $report->statusClass() }}" style="font-size:14px;padding:8px 14px;">
      Status: {{ $report->statusLabel() }}
    </span>
  </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;" class="report-detail-grid">

  <!-- Left Column: Message Detail -->
  <div>
    <div class="card" style="padding:28px;margin-bottom:24px;">
      <h3 style="margin:0 0 16px;font-size:17px;font-weight:800;border-bottom:1px solid var(--line-soft);padding-bottom:12px;">
        <i class="bi bi-card-text" style="color:var(--green-600);margin-right:6px;"></i> Rincian Pesan &amp; Pengaduan
      </h3>

      <div style="margin-bottom:16px;">
        <span style="font-size:12px;font-weight:700;color:var(--ink-soft);text-transform:uppercase;">Kategori Masalah:</span>
        <div style="font-size:16px;font-weight:700;color:var(--green-800);margin-top:2px;">
          {{ $report->category }}
        </div>
      </div>

      @if ($report->booking_code)
        <div style="margin-bottom:16px;">
          <span style="font-size:12px;font-weight:700;color:var(--ink-soft);text-transform:uppercase;">Kode Pemesanan Terkait:</span>
          <div style="margin-top:2px;">
            <code style="background:#F3F4F6;padding:4px 8px;border-radius:6px;font-size:14px;font-weight:700;">{{ $report->booking_code }}</code>
          </div>
        </div>
      @endif

      <div>
        <span style="font-size:12px;font-weight:700;color:var(--ink-soft);text-transform:uppercase;">Isi Pesan Lengkap:</span>
        <div style="margin-top:8px;padding:18px;background:#FAFBF9;border:1px solid var(--line);border-radius:10px;font-size:14.5px;line-height:1.7;white-space:pre-wrap;color:#1F2937;">{{ $report->message }}</div>
      </div>
    </div>

    <!-- Review & Action Form -->
    <div class="card" style="padding:28px;">
      <h3 style="margin:0 0 16px;font-size:17px;font-weight:800;border-bottom:1px solid var(--line-soft);padding-bottom:12px;">
        <i class="bi bi-pencil-square" style="color:var(--green-600);margin-right:6px;"></i> Tindak Lanjut Admin
      </h3>

      <form method="POST" action="{{ route('admin.reports.update', $report) }}" class="admin-form">
        @csrf
        @method('PUT')

        <div class="field" style="margin-bottom:16px;">
          <label for="status" style="display:block;font-weight:700;font-size:13px;margin-bottom:6px;">Ubah Status Laporan</label>
          <select id="status" name="status" style="width:100%;padding:10px 12px;border:1px solid var(--line);border-radius:8px;background:#fff;font-weight:600;">
            <option value="pending" @selected($report->status === 'pending')>Menunggu Review</option>
            <option value="in_progress" @selected($report->status === 'in_progress')>Sedang Diproses</option>
            <option value="resolved" @selected($report->status === 'resolved')>Selesai (Sudah Dihubungi/Ditangani)</option>
            <option value="closed" @selected($report->status === 'closed')>Ditutup</option>
          </select>
        </div>

        <div class="field" style="margin-bottom:20px;">
          <label for="admin_notes" style="display:block;font-weight:700;font-size:13px;margin-bottom:6px;">Catatan Admin / Riwayat Balasan</label>
          <textarea id="admin_notes" name="admin_notes" rows="4" placeholder="Tuliskan catatan tindak lanjut, misalnya: 'Sudah dihubungi via WhatsApp pada jam 14:00 dan masalah pembayaran sudah diselesaikan'..." style="width:100%;padding:12px;border:1px solid var(--line);border-radius:8px;">{{ old('admin_notes', $report->admin_notes) }}</textarea>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center;">
          <button type="submit" class="btn-add">
            <i class="bi bi-check-lg"></i> Simpan Pembaruan Status
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Right Column: Sender Info -->
  <div>
    <div class="card" style="padding:24px;margin-bottom:20px;">
      <h3 style="margin:0 0 16px;font-size:16px;font-weight:800;border-bottom:1px solid var(--line-soft);padding-bottom:10px;">
        <i class="bi bi-person-lines-fill" style="color:var(--green-600);margin-right:6px;"></i> Informasi Pengirim
      </h3>

      <div style="margin-bottom:14px;">
        <div style="font-size:12px;color:var(--ink-soft);">Nama:</div>
        <div style="font-weight:700;font-size:15px;color:var(--ink);">{{ $report->name }}</div>
      </div>

      <div style="margin-bottom:14px;">
        <div style="font-size:12px;color:var(--ink-soft);">Email:</div>
        <div style="font-weight:700;font-size:14px;">
          <a href="mailto:{{ $report->email }}?subject=Tindak%20Lanjut%20Bantuan%20TiketBus%20%23{{ $report->id }}" style="color:var(--green-700);text-decoration:underline;">
            {{ $report->email }} <i class="bi bi-box-arrow-up-right" style="font-size:12px;"></i>
          </a>
        </div>
      </div>

      <div style="margin-bottom:14px;">
        <div style="font-size:12px;color:var(--ink-soft);">Nomor Telepon:</div>
        <div style="font-weight:700;font-size:14px;">
          @if ($report->phone)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $report->phone) }}" target="_blank" style="color:var(--green-700);text-decoration:underline;">
              {{ $report->phone }} (WhatsApp <i class="bi bi-box-arrow-up-right" style="font-size:12px;"></i>)
            </a>
          @else
            <span style="color:var(--ink-soft);">-</span>
          @endif
        </div>
      </div>

      @if ($report->user)
        <div style="margin-bottom:14px;padding-top:10px;border-top:1px dashed var(--line-soft);">
          <div style="font-size:12px;color:var(--ink-soft);">Akun Terdaftar:</div>
          <div style="font-weight:700;color:var(--green-700);">
            <i class="bi bi-check-circle-fill"></i> Pengguna Terdaftar (ID #{{ $report->user_id }})
          </div>
        </div>
      @endif
    </div>

    <!-- Delete Action Box -->
    <div class="card" style="padding:20px;border-color:#FCA5A5;background:#FFF5F5;">
      <h4 style="margin:0 0 6px;color:#991B1B;font-size:14px;">Hapus Laporan</h4>
      <p style="margin:0 0 12px;font-size:12px;color:#7F1D1D;">Gunakan jika laporan ini terindikasi spam atau data uji coba.</p>
      <form method="POST" action="{{ route('admin.reports.destroy', $report) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini secara permanen?')">
        @csrf
        @method('DELETE')
        <button type="submit" style="background:#DC2626;color:#fff;border:none;padding:7px 14px;border-radius:6px;font-size:12px;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:6px;">
          <i class="bi bi-trash"></i> Hapus Laporan
        </button>
      </form>
    </div>
  </div>

</div>
@endsection
