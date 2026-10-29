<?php

namespace Database\Seeders;

use App\Models\HelpReport;
use Illuminate\Database\Seeder;

class HelpReportSeeder extends Seeder
{
    public function run(): void
    {
        if (HelpReport::count() === 0) {
            HelpReport::create([
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@gmail.com',
                'phone' => '081298765432',
                'category' => 'Pembayaran & Konfirmasi',
                'booking_code' => 'BK-20261028-0012',
                'message' => 'Halo admin, saya sudah melakukan transfer ke rekening BCA untuk tiket bus rute Jakarta - Surabaya tadi siang, namun status tiket masih menunggu konfirmasi. Mohon bantuannya untuk dicek.',
                'status' => 'pending',
                'admin_notes' => null,
            ]);

            HelpReport::create([
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@gmail.com',
                'phone' => '085712345678',
                'category' => 'E-Tiket & Boarding',
                'booking_code' => 'BK-20261028-0045',
                'message' => 'Selamat sore, email konfirmasi e-tiket saya tidak sengaja terhapus. Apakah bisa dikirimkan ulang atau bisa saya unduh langsung di aplikasi?',
                'status' => 'in_progress',
                'admin_notes' => 'Sudah dipandu untuk mengunduh e-tiket PDF melalui menu Cek Pesanan.',
            ]);

            HelpReport::create([
                'name' => 'Bambang Sudarmono',
                'email' => 'bambang.sudarmono@gmail.com',
                'phone' => '082145678901',
                'category' => 'Reschedule & Refund',
                'booking_code' => 'BK-20261027-0089',
                'message' => 'Saya ingin mengajukan perubahan jam keberangkatan bus dari jam 14:00 menjadi jam 19:30 karena ada kendala pekerjaan mendadak. Mohon konfirmasi ketersediaan kursinya.',
                'status' => 'resolved',
                'admin_notes' => 'Jadwal berhasil dipindahkan ke bus jam 19:30 WIB.',
            ]);
        }
    }
}
