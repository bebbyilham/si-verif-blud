<?php

namespace Database\Seeders;

use App\Models\JenisDokumen;
use Illuminate\Database\Seeder;

class JenisDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisList = [
            'Pembayaran Gaji ASN',
            'Pembayaran Tambahan Penghasilan',
            'Pembayaran gaji pegawai kontrak',
            'Belanja Makan dan Minuman Tamu',
            'Belanja Makan dan Minuman Rapat',
            'Belanja Makan dan Minuman pelatihan, workshop, sosialisasi dan Bimtek (Swakelola)',
            'Belanja Makan dan Minuman pelatihan, workshop, sosialisasi dan Bimtek (Hotel)',
            'Belanja Jasa telepon, air, listrik, internet dll',
            'Belanja perjalanan dinas luar kota dalam provinsi',
            'Belanja Foto',
            'Belanja Spanduk/Baliho dll',
            'Belanja Media',
            'Belanja Jasa Lembaga Penyedia Pengamanan',
            'Belanja Jasa Lembaga Penyedia Kebersihan',
            'Belanja Fotocopy',
            'Belanja Fotocopy untuk peserta pelatihan, workshop, sosialisasi dll',
            'Belanja pemeliharaan Kendaraan',
            'Pembelian suku cadang',
            'Pembelian BBM',
            'Belanja pemeliharaan komputer /AC dan elektronik lainnya',
            'Belanja pemeliharaan Peralatann kantor (Meja, Kursi, dan Lemari)',
            'Belanja obat/alkes',
            'Belanja pengadaan barang dan jasa',
            'Belanja barang ATK, barang cetakan dll',
            'Belanja upah tukang (swakelola)',
            'Belanja Lembu',
            'Pembayaran Honorarium Dokter Jaga IGD',
        ];

        // Deduplicate in case of duplicate entries
        $jenisList = array_values(array_unique($jenisList));

        foreach ($jenisList as $nama) {
            JenisDokumen::firstOrCreate(
                ['kode_jenis' => $nama],
                [
                    'kode_jenis' => $nama,
                    'nama_jenis' => $nama,
                    'deskripsi' => $nama,
                ]
            );
        }
    }
}
