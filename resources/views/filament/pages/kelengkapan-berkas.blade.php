<x-filament-panels::page>
    @php
$categories = [
          'gaji_asn' => 
          [
            'nama' => 'Pembayaran Gaji ASN',
            'kode' => 'SPP-LS Gaji',
            'icon' => 'heroicon-o-users',
            'deskripsi' => 'Kelengkapan berkas untuk pencairan belanja gaji.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Kuitansi induk untuk setiap SPP-LS gaji dll yang ditandatangani oleh PA, Bendahara dan salah satu penerima gaji',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Daftar tanda terima uang/Amprah gaji',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Rekapitulasi daftar gaji dan tunjangan (termasuk Daftar perubahan data pegawai & Salinan dokumen pendukung perubahan data pegawai yang telah dilegalisasi]',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
            ],
          ],
          'tambahan_penghasilan' => 
          [
            'nama' => 'Pembayaran Tambahan Penghasilan',
            'kode' => 'SPP-LS TPP',
            'icon' => 'heroicon-o-banknotes',
            'deskripsi' => 'Kelengkapan berkas untuk pencairan tambahan penghasilan.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'SK TPP',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Kuitansi induk',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Rekapitulasi/ Daftar Absensi/Pemotongan',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Daftar pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'SKP Online dari BKD',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
            ],
          ],
          'gaji_kontrak' => 
          [
            'nama' => 'Pembayaran gaji pegawai kontrak',
            'kode' => 'SPP-LS Kontrak',
            'icon' => 'heroicon-o-user-group',
            'deskripsi' => 'Kelengkapan berkas untuk pencairan gaji pegawai kontrak.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'SK Pengangkatan sbg tenaga honorer',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Kuitansi induk',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Daftar pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'print out absensi',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
            ],
          ],
          'mamin_tamu' => 
          [
            'nama' => 'Belanja Makan dan Minuman Tamu',
            'kode' => 'SPP-LS/GU Mamin',
            'icon' => 'heroicon-o-cake',
            'deskripsi' => 'Kelengkapan berkas belanja makan dan minuman tamu.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Faktur makan/Minum yang ditanda tangani pemilik warung',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Daftar hadir tamu',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
            ],
          ],
          'mamin_rapat' => 
          [
            'nama' => 'Belanja Makan dan Minuman Rapat',
            'kode' => 'SPP-LS/GU Mamin',
            'icon' => 'heroicon-o-users',
            'deskripsi' => 'Kelengkapan berkas belanja makan dan minuman rapat.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Undangan rapat',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Daftar hadir peserta rapat ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Faktur makan/Minum yang ditanda tangani pemilik warung',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
            ],
          ],
          'mamin_pelatihan_swakelola' => 
          [
            'nama' => 'Belanja Makan dan Minuman pelatihan, workshop, sosialisasi dan Bimtek (Swakelola]',
            'kode' => 'SPP-LS/GU Mamin',
            'icon' => 'heroicon-o-academic-cap',
            'deskripsi' => 'Kelengkapan berkas belanja mamin pelatihan (Swakelola].',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Daftar hadir peserta ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Faktur makan/Minum yang ditanda tangani pemilik warung',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Undangan Sosialisasi/Bimtek',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Daftar setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
            ],
          ],
          'mamin_pelatihan_hotel' => 
          [
            'nama' => 'Belanja Makan dan Minuman pelatihan, workshop, sosialisasi dan Bimtek (Hotel]',
            'kode' => 'SPP-LS/GU Mamin',
            'icon' => 'heroicon-o-building-office',
            'deskripsi' => 'Kelengkapan berkas belanja mamin pelatihan (Hotel].',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Notulen',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Bill pembayaran hotel',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'SPK (kontrak diatas 50jt]',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Daftar hadir peserta ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
            ],
          ],
          'jasa_utilitas' => 
          [
            'nama' => 'Belanja Jasa telepon, air, listrik, internet dll',
            'kode' => 'SPP-LS/GU Jasa',
            'icon' => 'heroicon-o-wifi',
            'deskripsi' => 'Kelengkapan berkas belanja jasa utilitas.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Bukti faktur/resi pembayaran tagihan',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
            ],
          ],
          'perjadin_dalam_provinsi' => 
          [
            'nama' => 'Belanja perjalanan dinas luar kota dalam provinsi',
            'kode' => 'SPP-LS/GU Perjadin',
            'icon' => 'heroicon-o-paper-airplane',
            'deskripsi' => 'Kelengkapan berkas perjalanan dinas dalam provinsi.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Surat undangan/telaah staf yang disetujui pejabat yang berwenang',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'SPPD yang ditanda tangani oleh pejabat yang berwenang',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Daftar pembayaran uang harian',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Surat tugas',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Biaya penginapan/bill hotel',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
              6 => 
              [
                'nama' => 'Tiket kendaraan umum atau faktur bbm',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 7,
              ],
              7 => 
              [
                'nama' => 'Laporan perjalanan dinas',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 8,
              ],
            ],
          ],
          'belanja_foto' => 
          [
            'nama' => 'Belanja Foto',
            'kode' => 'SPP-LS/GU Cetak',
            'icon' => 'heroicon-o-camera',
            'deskripsi' => 'Kelengkapan berkas belanja cetak foto.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat pesanan untuk pengadaan yang nilainya 1jt ke atas dan ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Faktur yang merinci jumlah dan ukuran foto',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Bukti fisik foto yang dicetak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
            ],
          ],
          'belanja_spanduk' => 
          [
            'nama' => 'Belanja Spanduk/Baliho dll',
            'kode' => 'SPP-LS/GU Cetak',
            'icon' => 'heroicon-o-printer',
            'deskripsi' => 'Kelengkapan berkas belanja cetak spanduk/baliho.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat pesanan yang didalamnya tertera kalimat spanduk dan ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Faktur yang mencantumkan ukurannya',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Foto spanduk yang dicetak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
            ],
          ],
          'belanja_media' => 
          [
            'nama' => 'Belanja Media',
            'kode' => 'SPP-LS/GU Cetak',
            'icon' => 'heroicon-o-newspaper',
            'deskripsi' => 'Kelengkapan berkas belanja media cetak/online.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat pesanan yang didalamnya tertera kalimat spanduk dan ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Faktur yang mencantumkan ukurannya',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Copy kliping koran, CD rekaman TV dan Print out media online',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Kuitansi pembayaran rinci',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
            ],
          ],
          'jasa_pengamanan' => 
          [
            'nama' => 'Belanja Jasa Lembaga Penyedia Pengamanan',
            'kode' => 'SPP-LS Jasa',
            'icon' => 'heroicon-o-shield-check',
            'deskripsi' => 'Kelengkapan berkas belanja jasa pengamanan.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat Perjanjian Kerjasama',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Faktur',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Berita acara serah terima antara penyedia dan KPA',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Berita acara pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
              6 => 
              [
                'nama' => 'Daftar tanda terima gaji masing-masing anggota',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 7,
              ],
              7 => 
              [
                'nama' => 'Rekap absensi',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 8,
              ],
              8 => 
              [
                'nama' => 'Laporan Pelaksanaan',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 9,
              ],
              9 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 10,
              ],
            ],
          ],
          'jasa_kebersihan' => 
          [
            'nama' => 'Belanja Jasa Lembaga Penyedia Kebersihan',
            'kode' => 'SPP-LS Jasa',
            'icon' => 'heroicon-o-sparkles',
            'deskripsi' => 'Kelengkapan berkas belanja jasa kebersihan.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat Perjanjian Kerjasama',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Faktur',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Berita acara serah terima antara penyedia dan KPA',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Berita acara pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
              6 => 
              [
                'nama' => 'Daftar tanda terima gaji masing-masing anggota',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 7,
              ],
              7 => 
              [
                'nama' => 'Rekap absensi',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 8,
              ],
              8 => 
              [
                'nama' => 'Laporan Pelaksanaan',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 9,
              ],
              9 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 10,
              ],
            ],
          ],
          'fotocopy' => 
          [
            'nama' => 'Belanja Fotocopy',
            'kode' => 'SPP-LS/GU ATK',
            'icon' => 'heroicon-o-document-duplicate',
            'deskripsi' => 'Kelengkapan berkas belanja fotocopy.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat pesanan untuk pengadaan yang nilainya 1jt ke atas dan ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Faktur yang merinci jumlah barang dan satuan',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
            ],
          ],
          'fotocopy_pelatihan' => 
          [
            'nama' => 'Belanja Fotocopy untuk peserta pelatihan, workshop, sosialisasi dll',
            'kode' => 'SPP-LS/GU ATK',
            'icon' => 'heroicon-o-book-open',
            'deskripsi' => 'Kelengkapan berkas belanja fotocopy untuk pelatihan.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat Perjanjian Kerjasama',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Faktur',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Berita acara serah terima antara penyedia dan KPA',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Berita acara pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
              6 => 
              [
                'nama' => 'Daftar tanda terima bahan oleh peserta',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 7,
              ],
              7 => 
              [
                'nama' => 'Dokumentasi/ foto',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 8,
              ],
              8 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 9,
              ],
            ],
          ],
          'pemeliharaan_kendaraan' => 
          [
            'nama' => 'Belanja pemeliharaan Kendaraan',
            'kode' => 'SPP-LS/GU Pemeliharaan',
            'icon' => 'heroicon-o-truck',
            'deskripsi' => 'Kelengkapan berkas belanja pemeliharaan kendaraan.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat permintaan service dari pemegang kendaraan',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Surat pesanan ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Faktur yang merinci service yang dilakukan serta mencantumkan plat kendaraan',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Kuitansi pembayaran (tanda legialisasi service kendaraan dibelakang lembar kuitansi oleh pemegang kendaraan]',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
            ],
          ],
          'suku_cadang' => 
          [
            'nama' => 'Pembelian suku cadang',
            'kode' => 'SPP-LS/GU Suku Cadang',
            'icon' => 'heroicon-o-cog',
            'deskripsi' => 'Kelengkapan berkas belanja pembelian suku cadang kendaraan/alat.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat permintaan dari pemakai barang',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Surat pesanan ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Faktur merinci suku cadang yang dibeli, harga, jumlah dan merk',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Kuitansi pembayaran (tanda penggantian suku cadang kendaraan dibelakang lembaran kuitansi oleh pemakai kendaraan]',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Bukti setoran pajak (* khusus suku cadang yang diganti disimpan sampai dengan waktu pemeriksaan]',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
            ],
          ],
          'bbm' => 
          [
            'nama' => 'Pembelian BBM',
            'kode' => 'SPP-LS/GU BBM',
            'icon' => 'heroicon-o-funnel',
            'deskripsi' => 'Kelengkapan berkas belanja pembelian bahan bakar minyak (BBM].',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat pesanan ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Faktur yang memuat jumlah liter BBM dikali dengan harga perliter',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Kuitansi pembayaran yang dilegalisasi oleh SPBU',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Daftar tanda terima kupon dari SPBU',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
            ],
          ],
          'pemeliharaan_komputer' => 
          [
            'nama' => 'Belanja pemeliharaan komputer /AC dan elektronik lainnya',
            'kode' => 'SPP-LS/GU Pemeliharaan',
            'icon' => 'heroicon-o-computer-desktop',
            'deskripsi' => 'Kelengkapan berkas belanja pemeliharaan elektronik.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat permintaan service dari pemegang barang',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Surat pesanan untuk pengadaan yang nilainya 1jt ke atas dan ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Faktur yang merinci penggantian yang diperbaiki',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
            ],
          ],
          'pemeliharaan_peralatan' => 
          [
            'nama' => 'Belanja pemeliharaan Peralatann kantor (Meja, Kursi, dan Lemari]',
            'kode' => 'SPP-LS/GU Pemeliharaan',
            'icon' => 'heroicon-o-wrench-screwdriver',
            'deskripsi' => 'Kelengkapan berkas belanja pemeliharaan peralatan kantor.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat permintaan service dari pemakai barang',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Surat pesanan untuk pengadaan yang nilainya 1jt ke atas dan ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Faktur yang merinci penggantian yang diperbaiki',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
              6 => 
              [
                'nama' => 'Dokumentasi sebelum dan sesudah di service',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 7,
              ],
            ],
          ],
          'obat_alkes' => 
          [
            'nama' => 'Belanja obat/alkes',
            'kode' => 'SPP-LS Farmasi',
            'icon' => 'heroicon-o-beaker',
            'deskripsi' => 'Kelengkapan berkas belanja obat/alat kesehatan.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat pesanan untuk pengadaan yang nilainya 1jt ke atas dan ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Faktur yang merinci jumlah barang dan satuan',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'BAST yang ditanda tangani oleh KPA dan Penyedia',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Berita acara pemeriksaan barang',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
              6 => 
              [
                'nama' => 'Dokumentasi atau foto',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 7,
              ],
              7 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 8,
              ],
            ],
          ],
          'pengadaan_barang' => 
          [
            'nama' => 'Belanja pengadaan barang dan jasa',
            'kode' => 'SPP-LS Rekanan',
            'icon' => 'heroicon-o-shopping-cart',
            'deskripsi' => 'Kelengkapan berkas belanja pengadaan barang dan jasa.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat pesanan untuk pengadaan yang nilainya 1jt ke atas dan ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Faktur yang merinci jumlah barang dan satuan',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'BAST yang ditanda tangani oleh KPA dan Penyedia',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Berita acara pemeriksaan barang',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
              6 => 
              [
                'nama' => 'Dokumentasi atau foto',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 7,
              ],
              7 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 8,
              ],
            ],
          ],
          'barang_atk' => 
          [
            'nama' => 'Belanja barang ATK, barang cetakan dll',
            'kode' => 'SPP-LS/GU ATK',
            'icon' => 'heroicon-o-clipboard-document',
            'deskripsi' => 'Kelengkapan berkas belanja barang ATK, cetakan, dll.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat pesanan untuk pengadaan yang nilainya 1jt ke atas dan ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Faktur yang merinci jumlah barang dan satuan',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'BAST yang ditanda tangani oleh PPTK dan Penyedia',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Berita acara pemeriksaan barang',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
              6 => 
              [
                'nama' => 'Dokumentasi atau foto',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 7,
              ],
              7 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 8,
              ],
            ],
          ],
          'upah_tukang' => 
          [
            'nama' => 'Belanja upah tukang (swakelola]',
            'kode' => 'SPP-LS/GU Upah',
            'icon' => 'heroicon-o-wrench-screwdriver',
            'deskripsi' => 'Kelengkapan berkas belanja upah tukang (swakelola).',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat permintaan yang ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Kuitansi pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Daftar pembayaran',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Daftar hadir tukang yang diketahui oleh',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
            ],
          ],
          'lembur' => 
          [
            'nama' => 'Belanja Lembur',
            'kode' => 'SPP-LS/GU Lembur',
            'icon' => 'heroicon-o-clock',
            'deskripsi' => 'Kelengkapan berkas belanja lembur pegawai.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Surat Perintah Lembur yang ditanda tanganii PA',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Kuitansi induk yang ditanda tangani salah satu seorang penerima lembur',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Daftar hadir yang ditanda tangani oleh PPTK',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Fotocopy cetakan dari hasi absensi online',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
              5 => 
              [
                'nama' => 'Daftar penerima pembayaran lembur',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 6,
              ],
              6 => 
              [
                'nama' => 'Bukti setoran pajak',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 7,
              ],
              7 => 
              [
                'nama' => 'Lampirkan faktur makan minum lembur jika ada',
                'kategori' => 'Kondisional',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 8,
              ],
            ],
          ],
          'honor_dokter' => 
          [
            'nama' => 'Pembayaran Honorarium Dokter Jaga IGD',
            'kode' => 'SPP-LS Honor',
            'icon' => 'heroicon-o-plus-circle',
            'deskripsi' => 'Kelengkapan berkas pembayaran honorarium dokter jaga IGD.',
            'items' => 
            [
              0 => 
              [
                'nama' => 'Nota persetujuan PA utk nilai diatas 1jt dan KPA utk nilai sd 1jt',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 1,
              ],
              1 => 
              [
                'nama' => 'Kuitansi pembayaran induk yang di tanda tangani salah satu pernerima honor',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 2,
              ],
              2 => 
              [
                'nama' => 'Daftar pembayaran honorarium',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 3,
              ],
              3 => 
              [
                'nama' => 'Daftar Dinas',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 4,
              ],
              4 => 
              [
                'nama' => 'Daftar hadir/kedatangan',
                'kategori' => 'Wajib',
                'format' => 'Cetak/PDF',
                'keterangan' => '',
                'no' => 5,
              ],
            ],
          ],
];

        $currentData = $categories[$activeCategory] ?? $categories['gaji_asn'];
        $items = $currentData['items'];
        $filteredCategories = $categories;

        if (!empty($searchQuery)) {
            $query = strtolower($searchQuery);
            $items = array_filter($items, function($item) use ($query) {
                return str_contains(strtolower($item['nama']), $query) 
                    || str_contains(strtolower($item['keterangan']), $query)
                    || str_contains(strtolower($item['format']), $query);
            });

            $filteredCategories = array_filter($categories, function($cat) use ($query) {
                return str_contains(strtolower($cat['nama']), $query)
                    || str_contains(strtolower($cat['deskripsi']), $query);
            });
        }

        $totalItems = count($currentData['items']);
        $checkedCount = 0;
        foreach ($currentData['items'] as $item) {
            $key = $activeCategory . '_' . $item['no'];
            if (isset($checkedItems[$key]) && $checkedItems[$key] === 'ada') {
                $checkedCount++;
            }
        }
        $progressPct = $totalItems > 0 ? round(($checkedCount / $totalItems) * 100) : 0;
    @endphp

    <div style="font-family: inherit;">

        <!-- CSS for Fallback Printing -->
        <style>
            @media screen {
                #lembar-verifikasi-cetak-wrapper {
                    display: none;
                }
            }
            @media print {
                .no-print,
                .fi-topbar,
                .fi-sidebar,
                .fi-breadcrumbs,
                header, nav, aside {
                    display: none !important;
                }
                html, body, .fi-layout, .fi-main, .fi-main-ctn, .fi-page {
                    background: #ffffff !important;
                    background-color: #ffffff !important;
                    color: #000000 !important;
                    margin: 0 !important;
                    padding: 0 !important;
                }
                #lembar-verifikasi-cetak-wrapper {
                    display: block !important;
                    width: 100% !important;
                    background: #ffffff !important;
                }
            }
        </style>

        <!-- ============================================================== -->
        <!-- SCREEN VIEW: Interactive Navigation & Content                  -->
        <!-- ============================================================== -->
        <div class="no-print">

            <!-- Banner Header -->
            <div style="position: relative; overflow: hidden; border-radius: 16px; background: linear-gradient(135deg, #312e81 0%, #4338ca 50%, #4f46e5 100%); padding: 24px 28px; color: #ffffff; box-shadow: 0 10px 25px -5px rgba(29, 78, 216, 0.35); margin-bottom: 20px;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px;">
                    <div>
                        <div style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; background: rgba(255, 255, 255, 0.18); backdrop-filter: blur(8px); border-radius: 999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #ffffff; margin-bottom: 8px;">
                            <span style="display: flex; align-items: center; gap: 4px;"><x-heroicon-o-scale style="width: 14px; height: 14px;" /> Dasar Hukum: Permendagri No. 77 Tahun 2020</span>
                        </div>
                        <h1 style="font-size: 22px; font-weight: 800; margin: 0 0 6px; color: #ffffff; line-height: 1.25; letter-spacing: -0.01em;">
                            Pedoman Kelengkapan Berkas Dokumen Pengeluaran
                        </h1>
                        <p style="font-size: 13.5px; line-height: 1.5; color: rgba(238, 242, 255, 0.92); max-width: 720px; margin: 0;">
                            Daftar ceklis bukti verifikasi yang harus dilengkapi oleh <strong>PPTK</strong> sebelum mengajukan dokumen dan menjadi pedoman pemeriksaan oleh <strong>Subbag Akuntansi, Verifikasi dan Perbendaharaan</strong>.
                        </p>
                    </div>

                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <button 
                            type="button" 
                            onclick="window.printLembarVerifikasi()" 
                            style="display: inline-flex; align-items: center; gap: 6px; padding: 9px 16px; border-radius: 10px; background: #ffffff; color: #312e81; font-size: 13px; font-weight: 700; border: none; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.15); transition: all 0.2s;"
                        >
                            <x-heroicon-o-printer style="width: 16px; height: 16px;" />
                            <span>Cetak Lembar Verifikasi</span>
                        </button>

                    </div>
                </div>
            </div>

            <!-- Main View Tabs (Ceklis Interaktif vs Format Lembar Cetak) -->
            <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 10px; padding-bottom: 14px; border-bottom: 1px solid #e2e8f0; margin-bottom: 20px;">
                <button 
                    type="button"
                    wire:click="setTab('ceklis')" 
                    style="display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; border-radius: 10px; font-weight: 700; font-size: 13.5px; border: 1px solid; cursor: pointer; transition: all 0.2s ease; {{ $activeTab === 'ceklis' ? 'background: #4f46e5; color: #ffffff; border-color: #4338ca; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);' : 'background: #ffffff; color: #475569; border-color: #cbd5e1;' }}"
                >
                    <x-heroicon-o-clipboard-document-check style="width: 20px; height: 20px;" />
                    <span>Daftar &amp; Ceklis Berkas Interaktif</span>
                </button>

                <button 
                    type="button"
                    wire:click="setTab('lembar_cetak')" 
                    style="display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; border-radius: 10px; font-weight: 700; font-size: 13.5px; border: 1px solid; cursor: pointer; transition: all 0.2s ease; {{ $activeTab === 'lembar_cetak' ? 'background: #4f46e5; color: #ffffff; border-color: #4338ca; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);' : 'background: #ffffff; color: #475569; border-color: #cbd5e1;' }}"
                >
                    <x-heroicon-o-document-text style="width: 20px; height: 20px;" />
                    <span>Pratinjau Format Lembar Verifikasi Resmi</span>
                </button>
            </div>

            <!-- ========================================================== -->
            <!-- TAB 1: DAFTAR & CEKLIS BERKAS INTERAKTIF                   -->
            <!-- ========================================================== -->
            @if($activeTab === 'ceklis')
                <!-- Category Filter Tabs Bar -->
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 14px 18px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; flex-wrap: wrap; gap: 10px;">
                        <span style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; display: flex; align-items: center; gap: 6px;">
                            <x-heroicon-o-folder style="width: 16px; height: 16px;" /> Pilih Kategori Transaksi Pengeluaran
                        </span>

                        <!-- Search Input Box -->
                        <div style="position: relative; min-width: 240px;">
                            <input 
                                type="text" 
                                wire:model.live.debounce.300ms="searchQuery" 
                                placeholder="Cari nama berkas / kata kunci..." 
                                style="width: 100%; padding: 7px 12px 7px 32px; font-size: 12.5px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; transition: border-color 0.2s;"
                            />
                            <span style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #94a3b8;"><x-heroicon-m-magnifying-glass style="width: 16px; height: 16px;" /></span>
                        </div>
                    </div>

                    <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                        @foreach($filteredCategories as $key => $cat)
                            @php
                                $isActive = ($activeCategory === $key);
                            @endphp
                            <button 
                                type="button" 
                                wire:click="setCategory('{{ $key }}')" 
                                style="display: inline-flex; align-items: center; gap: 7px; padding: 8px 14px; border-radius: 10px; font-size: 12.5px; font-weight: 700; border: 1px solid; cursor: pointer; transition: all 0.2s ease; {{ $isActive ? 'background: #4f46e5; color: #ffffff; border-color: #4338ca; box-shadow: 0 3px 10px rgba(79,70,229,0.3);' : 'background: #f8fafc; color: #334155; border-color: #e2e8f0;' }}"
                            >
                                <x-dynamic-component :component="$cat['icon']" style="width: 16px; height: 16px;" />
                                <span>{{ $cat['nama'] }}</span>
                                <span style="display: inline-block; padding: 1px 6px; border-radius: 6px; font-size: 11px; font-weight: 800; {{ $isActive ? 'background: rgba(255,255,255,0.25); color: #ffffff;' : 'background: #e2e8f0; color: #64748b;' }}">
                                    {{ count($cat['items']) }}
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Active Category Header Card & Progress -->
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 18px 22px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px;">
                        <div style="display: flex; align-items: center; gap: 14px;">
                            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(79,70,229,0.1); color: #4f46e5; font-size: 22px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <x-dynamic-component :component="$currentData['icon']" style="width: 24px; height: 24px;" />
                            </div>
                            <div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <h2 style="font-size: 17px; font-weight: 800; margin: 0; color: #0f172a;">
                                        {{ $currentData['nama'] }}
                                    </h2>
                                    <span style="display: inline-block; padding: 2px 8px; border-radius: 6px; font-size: 11px; font-weight: 700; background: #eef2ff; color: #4f46e5; border: 1px solid #c7d2fe;">
                                        {{ $currentData['kode'] }}
                                    </span>
                                </div>
                                <p style="font-size: 12.5px; color: #64748b; margin: 3px 0 0;">
                                    {{ $currentData['deskripsi'] }}
                                </p>
                            </div>
                        </div>

                        <!-- Progress Checklist Badge -->
                        <div style="display: flex; align-items: center; gap: 14px; background: #f8fafc; border: 1px solid #e2e8f0; padding: 10px 16px; border-radius: 12px;">
                            <div>
                                <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Simulasi Ceklis</div>
                                <div style="font-size: 14px; font-weight: 800; color: {{ $checkedCount === $totalItems ? '#059669' : '#4f46e5' }};">
                                    {{ $checkedCount }} dari {{ $totalItems }} Berkas Siap ({{ $progressPct }}%)
                                </div>
                            </div>
                            <div style="width: 80px; height: 8px; background: #e2e8f0; border-radius: 999px; overflow: hidden;">
                                <div style="width: {{ $progressPct }}%; height: 100%; background: {{ $checkedCount === $totalItems ? '#10b981' : '#4f46e5' }}; transition: width 0.3s ease;"></div>
                            </div>
                            @if($checkedCount > 0)
                                <button 
                                    type="button" 
                                    wire:click="resetChecklist" 
                                    style="font-size: 11px; color: #ef4444; background: none; border: none; cursor: pointer; text-decoration: underline; font-weight: 600;"
                                >
                                    Reset
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Table of Required Documents -->
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.04); margin-bottom: 22px;">
                    <div style="padding: 14px 20px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
                        <span style="font-size: 13px; font-weight: 700; color: #334155; display: flex; align-items: center; gap: 6px;">
                            <x-heroicon-o-clipboard-document-list style="width: 16px; height: 16px;" /> Rincian Bukti &amp; Dokumen yang Wajib Dilengkapi
                        </span>
                        <span style="font-size: 11.5px; color: #64748b; font-style: italic;">
                            Klik tombol <strong>[√ Ada]</strong> untuk memeriksa kelengkapan berkas Anda
                        </span>
                    </div>

                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 13px;">
                            <thead>
                                <tr style="background: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
                                    <th style="padding: 12px 16px; width: 48px; text-align: center; font-weight: 700; color: #475569; font-size: 11px; text-transform: uppercase;">No</th>
                                    <th style="padding: 12px 16px; font-weight: 700; color: #475569; font-size: 11px; text-transform: uppercase;">Bukti yang Harus Dilengkapi</th>
                                    <th style="padding: 12px 16px; width: 120px; text-align: center; font-weight: 700; color: #475569; font-size: 11px; text-transform: uppercase;">Sifat</th>
                                    <th style="padding: 12px 16px; width: 150px; text-align: center; font-weight: 700; color: #475569; font-size: 11px; text-transform: uppercase;">Format Disarankan</th>
                                    <th style="padding: 12px 16px; width: 160px; text-align: center; font-weight: 700; color: #475569; font-size: 11px; text-transform: uppercase;">Status Ceklis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                    @php
                                        $itemKey = $activeCategory . '_' . $item['no'];
                                        $status = $checkedItems[$itemKey] ?? null;
                                        $isAda = ($status === 'ada');
                                        $isTidak = ($status === 'tidak_ada');
                                    @endphp
                                    <tr style="border-bottom: 1px solid #f1f5f9; {{ $isAda ? 'background: rgba(16,185,129,0.04);' : ($isTidak ? 'background: rgba(239,68,68,0.04);' : '') }}">
                                        <td style="padding: 14px 16px; text-align: center; font-weight: 700; color: #64748b; vertical-align: top;">
                                            {{ $item['no'] }}
                                        </td>
                                        <td style="padding: 14px 16px; vertical-align: top;">
                                            <div style="font-weight: 700; color: #0f172a; margin-bottom: 4px; line-height: 1.45;">
                                                {{ $item['nama'] }}
                                            </div>
                                            <div style="font-size: 12px; color: #64748b; line-height: 1.45;">
                                                {{ $item['keterangan'] }}
                                            </div>
                                        </td>
                                        <td style="padding: 14px 16px; text-align: center; vertical-align: top;">
                                            @if(str_contains($item['kategori'], 'Wajib'))
                                                <span style="display: inline-block; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 700; background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5;">
                                                    {{ $item['kategori'] }}
                                                </span>
                                            @else
                                                <span style="display: inline-block; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 700; background: #fef3c7; color: #92400e; border: 1px solid #fcd34d;">
                                                    {{ $item['kategori'] }}
                                                </span>
                                            @endif
                                        </td>
                                        <td style="padding: 14px 16px; text-align: center; vertical-align: top;">
                                            <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 8px; border-radius: 4px; font-size: 11px; font-weight: 600; background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
                                                <x-heroicon-o-document style="width: 14px; height: 14px;" /> {{ $item['format'] }}
                                            </span>
                                        </td>
                                        <td style="padding: 14px 16px; text-align: center; vertical-align: top;">
                                            <div style="display: inline-flex; align-items: center; gap: 4px;">
                                                <button 
                                                    type="button" 
                                                    wire:click="toggleCheck('{{ $itemKey }}', 'ada')" 
                                                    style="padding: 5px 10px; border-radius: 6px; font-size: 12px; font-weight: 700; border: 1px solid; cursor: pointer; transition: all 0.15s; {{ $isAda ? 'background: #10b981; color: #ffffff; border-color: #059669;' : 'background: #ffffff; color: #059669; border-color: #a7f3d0;' }}"
                                                    title="Tandai berkas ADA"
                                                >
                                                    <span style="display: flex; align-items: center; gap: 4px;"><x-heroicon-m-check style="width: 16px; height: 16px;" /> Ada</span>
                                                </button>

                                                <button 
                                                    type="button" 
                                                    wire:click="toggleCheck('{{ $itemKey }}', 'tidak_ada')" 
                                                    style="padding: 5px 10px; border-radius: 6px; font-size: 12px; font-weight: 700; border: 1px solid; cursor: pointer; transition: all 0.15s; {{ $isTidak ? 'background: #ef4444; color: #ffffff; border-color: #dc2626;' : 'background: #ffffff; color: #dc2626; border-color: #fecaca;' }}"
                                                    title="Tandai berkas BELUM ADA"
                                                >
                                                    <span style="display: flex; align-items: center; gap: 4px;"><x-heroicon-m-x-mark style="width: 16px; height: 16px;" /> Tidak</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="padding: 30px; text-align: center; color: #94a3b8; font-style: italic;">
                                            Tidak ada berkas yang cocok dengan pencarian "{{ $searchQuery }}".
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Petunjuk Pengunggahan Berkas di Sistem -->
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 style="font-size: 15px; font-weight: 800; color: #0f172a; margin: 0 0 12px; display: flex; align-items: center; gap: 8px;">
                        <x-heroicon-o-light-bulb style="width: 20px; height: 20px;" /> Ketentuan Format Unggah Lampiran pada Sistem
                    </h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; font-size: 12.5px; color: #334155; line-height: 1.5;">
                        <div style="padding: 12px 16px; background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 10px;">
                            <strong style="color: #3730a3; display: block; margin-bottom: 3px;">1. File PDF Langsung (&le; 1 MB)</strong>
                            Jika ukuran file lampiran di bawah 1 Megabyte, unggah langsung file PDF melalui form pengajuan.
                        </div>
                        <div style="padding: 12px 16px; background: #fef3c7; border: 1px solid #fde68a; border-radius: 10px;">
                            <strong style="color: #92400e; display: block; margin-bottom: 3px;">2. Tautan Google Drive (> 1 MB)</strong>
                            Jika file lampiran berukuran besar (misal gabungan SPJ atau BAST bertanda tangan banyak halaman), unggah ke Google Drive dan masukkan tautan publik (<em>Anyone with link can view</em>).
                        </div>
                        <div style="padding: 12px 16px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px;">
                            <strong style="color: #166534; display: block; margin-bottom: 3px;">3. Penamaan Dokumen yang Jelas</strong>
                            Beri judul dokumen lampiran secara spesifik (Contoh: <em>Kuitansi Induk Gaji</em>, <em>BAST Barang</em>, <em>Faktur Pajak e-Faktur</em>) agar memudahkan verifikator memeriksa berkas.
                        </div>
                    </div>
                </div>
            @endif


            <!-- ========================================================== -->
            <!-- TAB 2: PRATINJAU FORMAT LEMBAR VERIFIKASI RESMI             -->
            <!-- ========================================================== -->
            @if($activeTab === 'lembar_cetak')
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px 24px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid #e2e8f0;">
                        <div>
                            <h2 style="font-size: 16px; font-weight: 800; color: #0f172a; margin: 0 0 2px;">
                                Pratinjau Lembar Verifikasi Standar Permendagri No. 77 Tahun 2020
                            </h2>
                            <p style="font-size: 12.5px; color: #64748b; margin: 0;">
                                Format resmi ceklis verifikasi Subbag Akuntansi, Verifikasi dan Perbendaharaan.
                            </p>
                        </div>

                        <div style="display: flex; gap: 10px; align-items: center;">
                            <button 
                                type="button" 
                                onclick="window.printLembarVerifikasi()" 
                                style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 8px; background: #4f46e5; color: #ffffff; font-size: 13px; font-weight: 700; border: none; cursor: pointer; box-shadow: 0 2px 8px rgba(79,70,229,0.25);"
                            >
                                <span style="display: flex; align-items: center; gap: 6px;"><x-heroicon-o-printer style="width: 16px; height: 16px;" /> Cetak Dokumen Ini</span>
                            </button>
                        </div>
                    </div>

                    <!-- Clean Paper Sheet Card Preview (Screen Mockup) -->
                    <div style="max-width: 820px; margin: 0 auto; background: #ffffff; padding: 32px 36px; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border: 1px solid #cbd5e1;">
                        
                        <!-- Inner Double Border -->
                        <div style="border: 3px double #000000; padding: 22px; background: #ffffff; font-family: 'Times New Roman', Times, serif; color: #000000; font-size: 11.5pt; line-height: 1.35;">

                            <!-- Header Info -->
                            <table style="width: 100%; border-collapse: collapse; margin-bottom: 12px;">
                                <tr>
                                    <td style="width: 170px; font-weight: bold; padding: 3px 0; font-size: 11pt;">No. Urut Verifikasi</td>
                                    <td style="width: 15px; text-align: center;">:</td>
                                    <td style="border-bottom: 1px dotted #000000; padding: 3px 0; font-weight: bold; font-size: 11pt;">
                                        {{ $nomorDokumen ?: '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; padding: 3px 0; font-size: 11pt;">Nama Transaksi</td>
                                    <td style="text-align: center;">:</td>
                                    <td style="font-weight: bold; padding: 3px 0; font-size: 11pt;">
                                        {{ $currentData['nama'] }}
                                    </td>
                                </tr>
                            </table>

                            <div style="margin-bottom: 10px;">
                                <div style="font-weight: bold; font-size: 11pt; line-height: 1.3;">Bukti yang harus dilengkapi</div>
                                <div style="font-size: 10pt; font-style: italic; line-height: 1.3;">
                                    (berdasarkan Permendagri No. 77 Th 2020 tentang pedoman Teknis Pengelolaan Keuangan)
                                </div>
                            </div>

                            <!-- Table Checklist -->
                            <table style="width: 100%; border-collapse: collapse; margin-bottom: 16px; border: 1px solid #000000;">
                                <thead>
                                    <tr style="background: #ffffff; border-bottom: 1px solid #000000;">
                                        <th style="border: 1px solid #000000; padding: 6px 4px; width: 35px; text-align: center; font-size: 10.5pt; font-weight: bold;">No</th>
                                        <th style="border: 1px solid #000000; padding: 6px 8px; text-align: left; font-size: 10.5pt; font-weight: bold;">Uraian Bukti Dokumen</th>
                                        <th style="border: 1px solid #000000; padding: 6px 4px; width: 65px; text-align: center; font-size: 10.5pt; font-weight: bold;">√ ada</th>
                                        <th style="border: 1px solid #000000; padding: 6px 4px; width: 65px; text-align: center; font-size: 10.5pt; font-weight: bold;">X tidak ada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($currentData['items'] as $item)
                                        @php
                                            $itemKey = $activeCategory . '_' . $item['no'];
                                            $status = $checkedItems[$itemKey] ?? null;
                                        @endphp
                                        <tr style="background: #ffffff;">
                                            <td style="border: 1px solid #000000; padding: 6px 4px; text-align: center; vertical-align: middle; font-size: 10.5pt;">
                                                {{ $item['no'] }}.
                                            </td>
                                            <td style="border: 1px solid #000000; padding: 6px 8px; vertical-align: middle; font-size: 10pt; line-height: 1.35;">
                                                {{ $item['nama'] }}
                                            </td>
                                            <td style="border: 1px solid #000000; padding: 4px; text-align: center; vertical-align: middle; font-size: 13pt; font-weight: bold;">
                                                {{ $status === 'ada' ? '✓' : '' }}
                                            </td>
                                            <td style="border: 1px solid #000000; padding: 4px; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold;">
                                                {{ $status === 'tidak_ada' ? '✗' : '' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Catatan Hasil Verifikasi -->
                            <div style="margin-bottom: 20px;">
                                <div style="font-weight: bold; margin-bottom: 4px; font-size: 10.5pt;">Catatan hasil verifikasi:</div>
                                <div style="border-bottom: 1px dotted #000000; height: 20px;"></div>
                                <div style="border-bottom: 1px dotted #000000; height: 20px;"></div>
                                <div style="border-bottom: 1px dotted #000000; height: 20px;"></div>
                                <div style="border-bottom: 1px dotted #000000; height: 20px;"></div>
                            </div>

                            <!-- Footer Tanda Tangan -->
                            <div style="display: flex; justify-content: flex-end; margin-top: 14px;">
                                <div style="text-align: center; width: 300px; font-size: 10.5pt;">
                                    <div>Padang, ……………………………………</div>
                                    <div style="height: 55px;"></div>
                                    <div style="font-weight: bold;">( ..................................................... )</div>
                                    <div style="font-size: 9.5pt; margin-top: 2px;">Subbag Akuntansi, Verifikasi dan Perbendaharaan</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

        </div>


        <!-- ============================================================== -->
        <!-- PRINT MASTER ELEMENT (Source for clean iframe printing)        -->
        <!-- ============================================================== -->
        <div id="lembar-verifikasi-cetak-wrapper">
            <div id="lembar-verifikasi-cetak-content" style="border: 3px double #000000; padding: 20px 22px; box-sizing: border-box; background: #ffffff; color: #000000; font-family: 'Times New Roman', Times, serif; font-size: 11pt; line-height: 1.35; width: 100%;">

                <!-- Header Info -->
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 12px; background: #ffffff;">
                    <tr>
                        <td style="width: 170px; font-weight: bold; padding: 3px 0; font-size: 11pt; color: #000000;">No. Urut Verifikasi</td>
                        <td style="width: 15px; text-align: center; color: #000000;">:</td>
                        <td style="border-bottom: 1px dotted #000000; padding: 3px 0; font-weight: bold; font-size: 11pt; color: #000000;">
                            {{ $nomorDokumen ?: '' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; padding: 4px 0 2px; font-size: 11pt; color: #000000;">Nama Transaksi</td>
                        <td style="text-align: center; color: #000000;">:</td>
                        <td style="font-weight: bold; padding: 4px 0 2px; font-size: 11pt; color: #000000;">
                            {{ $currentData['nama'] }}
                        </td>
                    </tr>
                </table>

                <div style="margin-bottom: 10px;">
                    <div style="font-weight: bold; font-size: 11pt; line-height: 1.3; color: #000000;">Bukti yang harus dilengkapi</div>
                    <div style="font-size: 10pt; font-style: italic; line-height: 1.3; color: #000000;">
                        (berdasarkan Permendagri No. 77 Th 2020 tentang pedoman Teknis Pengelolaan Keuangan)
                    </div>
                </div>

                <!-- Table Checklist -->
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 14px; border: 1px solid #000000; background: #ffffff;">
                    <thead>
                        <tr style="background: #ffffff; border-bottom: 1px solid #000000;">
                            <th style="border: 1px solid #000000; padding: 6px 4px; width: 35px; text-align: center; font-size: 10.5pt; font-weight: bold; color: #000000;">No</th>
                            <th style="border: 1px solid #000000; padding: 6px 8px; text-align: left; font-size: 10.5pt; font-weight: bold; color: #000000;">Uraian Bukti Dokumen</th>
                            <th style="border: 1px solid #000000; padding: 6px 4px; width: 65px; text-align: center; font-size: 10.5pt; font-weight: bold; color: #000000;">√ ada</th>
                            <th style="border: 1px solid #000000; padding: 6px 4px; width: 65px; text-align: center; font-size: 10.5pt; font-weight: bold; color: #000000;">X tidak<br>ada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($currentData['items'] as $item)
                            @php
                                $itemKey = $activeCategory . '_' . $item['no'];
                                $status = $checkedItems[$itemKey] ?? null;
                            @endphp
                            <tr style="background: #ffffff;">
                                <td style="border: 1px solid #000000; padding: 6px 4px; text-align: center; vertical-align: middle; font-size: 10.5pt; color: #000000;">
                                    {{ $item['no'] }}.
                                </td>
                                <td style="border: 1px solid #000000; padding: 6px 8px; vertical-align: middle; font-size: 10pt; line-height: 1.35; color: #000000;">
                                    {{ $item['nama'] }}
                                </td>
                                <td style="border: 1px solid #000000; padding: 4px; text-align: center; vertical-align: middle; font-size: 13pt; font-weight: bold; color: #000000;">
                                    {{ $status === 'ada' ? '✓' : '' }}
                                </td>
                                <td style="border: 1px solid #000000; padding: 4px; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; color: #000000;">
                                    {{ $status === 'tidak_ada' ? '✗' : '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Catatan Hasil Verifikasi -->
                <div style="margin-bottom: 16px;">
                    <div style="font-weight: bold; margin-bottom: 4px; font-size: 10.5pt; color: #000000;">Catatan hasil verifikasi:</div>
                    <div style="border-bottom: 1px dotted #000000; height: 20px;"></div>
                    <div style="border-bottom: 1px dotted #000000; height: 20px;"></div>
                    <div style="border-bottom: 1px dotted #000000; height: 20px;"></div>
                    <div style="border-bottom: 1px dotted #000000; height: 20px;"></div>
                </div>

                <!-- Footer Tanda Tangan -->
                <div style="display: flex; justify-content: flex-end; margin-top: 10px;">
                    <div style="text-align: center; width: 280px; font-size: 10.5pt; color: #000000;">
                        <div>Padang, …………………………………</div>
                        <div style="height: 50px;"></div>
                        <div style="font-weight: bold;">( ..................................................... )</div>
                        <div style="font-size: 9.5pt; margin-top: 2px;">Subbag Akuntansi, Verifikasi dan Perbendaharaan</div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        window.printLembarVerifikasi = function() {
            var content = document.getElementById('lembar-verifikasi-cetak-content');
            if (!content) {
                window.print();
                return;
            }

            var iframe = document.getElementById('print-clean-iframe');
            if (!iframe) {
                iframe = document.createElement('iframe');
                iframe.id = 'print-clean-iframe';
                iframe.style.position = 'fixed';
                iframe.style.right = '0';
                iframe.style.bottom = '0';
                iframe.style.width = '0';
                iframe.style.height = '0';
                iframe.style.border = '0';
                iframe.style.visibility = 'hidden';
                document.body.appendChild(iframe);
            }

            var iDoc = iframe.contentDocument || iframe.contentWindow.document;
            iDoc.head.innerHTML = '';
            iDoc.body.innerHTML = '';

            var title = iDoc.createElement('title');
            title.textContent = 'Lembar Verifikasi Kelengkapan Berkas';
            iDoc.head.appendChild(title);

            var style = iDoc.createElement('style');
            style.textContent = '@page { size: A4 portrait; margin: 12mm 15mm; } * { box-sizing: border-box; margin: 0; padding: 0; } html, body { background: #ffffff !important; color: #000000 !important; font-family: \'Times New Roman\', Times, serif; font-size: 11pt; padding: 0; margin: 0; width: 100%; } table { border-collapse: collapse; width: 100%; background: #ffffff !important; } th, td { background: #ffffff !important; color: #000000 !important; }';
            iDoc.head.appendChild(style);

            iDoc.body.appendChild(content.cloneNode(true));

            setTimeout(function() {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
            }, 200);
        };
    </script>
</x-filament-panels::page>
