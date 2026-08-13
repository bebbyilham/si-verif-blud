<x-filament-panels::page>
    @php
        $categories = [
            'gaji_asn' => [
                'nama' => 'Pembayaran Gaji ASN',
                'kode' => 'SPP-LS Gaji',
                'icon' => 'heroicon-o-users',
                'deskripsi' => 'Kelengkapan berkas untuk pencairan belanja gaji induk, tunjangan ASN, dan perubahan data pegawai.',
                'items' => [
                    [
                        'no' => 1,
                        'nama' => 'Kuitansi induk untuk setiap SPP-LS gaji dll yang ditandatangani oleh PA, Bendahara dan salah satu penerima gaji',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Asli Bertandatangan',
                        'keterangan' => 'Kuitansi induk harus ditandatangani oleh Pengguna Anggaran (PA), Bendahara Pengeluaran, dan perwakilan penerima gaji.',
                    ],
                    [
                        'no' => 2,
                        'nama' => 'Daftar tanda terima uang / Amprah gaji',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Rekapitulasi',
                        'keterangan' => 'Daftar penerimaan gaji per pegawai sesuai unit kerja yang telah ditandatangani / diverifikasi oleh bendahara.',
                    ],
                    [
                        'no' => 3,
                        'nama' => 'Rekapitulasi daftar gaji dan tunjangan',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Rincian Sistem',
                        'keterangan' => 'Rekapitulasi total gaji pokok, tunjangan keluarga, tunjangan jabatan, dan potongan resmi (IWP, Taperum, PPh 21).',
                    ],
                    [
                        'no' => 4,
                        'nama' => 'Daftar perubahan data pegawai',
                        'kategori' => 'Kondisional',
                        'format' => 'PDF Lampiran',
                        'keterangan' => 'Daftar rincian pegawai yang mengalami perubahan pangkat, golongan, mutasi masuk/keluar, kenaikan gaji berkala (KGB), atau pensiun.',
                    ],
                    [
                        'no' => 5,
                        'nama' => 'Salinan dokumen pendukung perubahan data pegawai yang telah dilegalisasi',
                        'kategori' => 'Kondisional',
                        'format' => 'PDF Legalisir',
                        'keterangan' => 'SK Kenaikan Pangkat, SK Jabatan, SK Mutasi, atau Akta Kelahiran/Keluarga yang telah dilegalisasi oleh pejabat kepegawaian berwenang.',
                    ],
                    [
                        'no' => 6,
                        'nama' => 'Bukti setoran pajak (PPh Pasal 21)',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Bukti Setor / SSP',
                        'keterangan' => 'Bukti Surat Setoran Pajak (SSP) atau Bukti Penerimaan Negara (BPN) potongan PPh Pasal 21 atas pembayaran gaji ASN.',
                    ],
                ]
            ],
            'barang_jasa' => [
                'nama' => 'Pengadaan Barang & Jasa',
                'kode' => 'SPP-LS Rekanan',
                'icon' => 'heroicon-o-cube',
                'deskripsi' => 'Kelengkapan berkas tagihan belanja pengadaan barang, jasa konsultansi, dan pekerjaan konstruksi dari pihak rekanan.',
                'items' => [
                    [
                        'no' => 1,
                        'nama' => 'Surat Permintaan Pembayaran Langsung (SPP-LS) & Surat Perintah Membayar (SPM)',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Asli Bertandatangan',
                        'keterangan' => 'Dokumen resmi pengajuan pencairan dana LS yang disahkan oleh PPTK dan PPK.',
                    ],
                    [
                        'no' => 2,
                        'nama' => 'Surat Perjanjian Kontrak / Surat Perintah Kerja (SPK) / Surat Pesanan (e-Katalog)',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Kontrak Lengkap',
                        'keterangan' => 'Salinan kontrak/SPK lengkap beserta syarat umum/khusus dan rincian harga yang disepakati.',
                    ],
                    [
                        'no' => 3,
                        'nama' => 'Berita Acara Pemeriksaan Hasil Pekerjaan (BAPH / BAPHP)',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Bertandatangan',
                        'keterangan' => 'Dibuat dan ditandatangani oleh Tim Panitia Penerima Hasil Pekerjaan (PPHP) / Pejabat Pemeriksa Hasil Pekerjaan.',
                    ],
                    [
                        'no' => 4,
                        'nama' => 'Berita Acara Serah Terima Hasil Pekerjaan / Barang (BAST)',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Bertandatangan',
                        'keterangan' => 'Dibuat dan ditandatangani bersama oleh PPK dan Rekanan / Penyedia Jasa.',
                    ],
                    [
                        'no' => 5,
                        'nama' => 'Berita Acara Pembayaran (BAP)',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Bertandatangan',
                        'keterangan' => 'Pernyataan kelayakan pembayaran sesuai termin atau prestasi pekerjaan yang telah dicapai (100%).',
                    ],
                    [
                        'no' => 6,
                        'nama' => 'Kuitansi Pembayaran & Faktur / Invoice Rekanan bermaterai cukup',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Asli Bermaterai',
                        'keterangan' => 'Kuitansi bermaterai Rp 10.000 asli dan tagihan resmi rekanan yang mencantumkan nama, nomor rekening bank, dan stempel basah.',
                    ],
                    [
                        'no' => 7,
                        'nama' => 'Faktur Pajak (e-Faktur) & Bukti Setor / Potong Pajak (PPN & PPh 22/23)',
                        'kategori' => 'Wajib',
                        'format' => 'PDF e-Faktur Resmi',
                        'keterangan' => 'e-Faktur Pajak yang valid dan barcode dapat dipindai sesuai NPWP rekanan dan RS.',
                    ],
                    [
                        'no' => 8,
                        'nama' => 'Salinan NPWP & Rekening Bank Rekanan',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Salinan',
                        'keterangan' => 'Konfirmasi nomor rekening perusahaan yang tercantum dalam kontrak untuk transfer pembayaran.',
                    ],
                    [
                        'no' => 9,
                        'nama' => 'Jaminan Pemeliharaan / Bank Garansi (jika dipersyaratkan)',
                        'kategori' => 'Kondisional',
                        'format' => 'PDF Jaminan Bank',
                        'keterangan' => 'Wajib dilampirkan untuk pekerjaan konstruksi/pengadaan alat yang memiliki masa retensi/pemeliharaan.',
                    ],
                ]
            ],
            'perjalanan_dinas' => [
                'nama' => 'Perjalanan Dinas',
                'kode' => 'SPP-LS / GU Perjadin',
                'icon' => 'heroicon-o-paper-airplane',
                'deskripsi' => 'Kelengkapan berkas pertanggungjawaban perjalanan dinas dalam daerah dan luar daerah.',
                'items' => [
                    [
                        'no' => 1,
                        'nama' => 'Surat Tugas (ST) resmi yang ditandatangani Pejabat Berwenang',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Asli Bertandatangan',
                        'keterangan' => 'Surat Tugas yang memuat nama pelaksana, maksud perjalanan, tanggal pelaksanaan, dan beban anggaran.',
                    ],
                    [
                        'no' => 2,
                        'nama' => 'Surat Perintah Perjalanan Dinas (SPPD) Lembar I & II',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Asli Bertandatangan & Cap',
                        'keterangan' => 'SPPD harus telah ditandatangani dan distempel basah oleh pejabat berwenang di lokasi tujuan perjalanan dinas.',
                    ],
                    [
                        'no' => 3,
                        'nama' => 'Laporan Pelaksanaan Hasil Perjalanan Dinas',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Laporan',
                        'keterangan' => 'Laporan tertulis hasil kegiatan, materi, hasil koordinasi/pelatihan, dan dokumentasi foto di lokasi tujuan.',
                    ],
                    [
                        'no' => 4,
                        'nama' => 'Kuitansi & Rincian Biaya Perjalanan Dinas (Daftar Pengeluaran Riil)',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Kuitansi',
                        'keterangan' => 'Rincian uang harian, uang transportasi, dan biaya penginapan sesuai Standar Satuan Harga (SSH) yang berlaku.',
                    ],
                    [
                        'no' => 5,
                        'nama' => 'Tiket Transportasi Asli (Boarding Pass Pesawat / Kereta / Bus)',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Tiket Asli',
                        'keterangan' => 'Boarding pass fisik asli dan e-ticket atas nama pegawai yang bersangkutan.',
                    ],
                    [
                        'no' => 6,
                        'nama' => 'Bukti Pembayaran / Invoice Hotel / Penginapan Asli',
                        'kategori' => 'Kondisional',
                        'format' => 'PDF Invoice Resmi',
                        'keterangan' => 'Bukti pembayaran hotel asli memuat nomor kamar, nama tamu, tanggal check-in & check-out.',
                    ],
                    [
                        'no' => 7,
                        'nama' => 'Struk Pembelian BBM dan Karcis Tol Resmi (Kendaraan Dinas)',
                        'kategori' => 'Kondisional',
                        'format' => 'PDF Struk Asli',
                        'keterangan' => 'Hanya dilampirkan jika perjalanan darat menggunakan kendaraan dinas operasional.',
                    ],
                ]
            ],
            'honorarium' => [
                'nama' => 'Honorarium & Narasumber',
                'kode' => 'SPP-LS / GU Honor',
                'icon' => 'heroicon-o-academic-cap',
                'deskripsi' => 'Kelengkapan berkas belanja honorarium narasumber, instruktur, tim pengelola kegiatan, dan panitia.',
                'items' => [
                    [
                        'no' => 1,
                        'nama' => 'Surat Keputusan (SK) Direktur / PA tentang Penetapan Tim / Narasumber',
                        'kategori' => 'Wajib',
                        'format' => 'PDF SK Resmi',
                        'keterangan' => 'SK Direktur yang menjadi dasar hukum pengangkatan tim atau narasumber beserta besaran satuan honor.',
                    ],
                    [
                        'no' => 2,
                        'nama' => 'Kerangka Acuan Kerja (KAK / TOR) & Surat Undangan Kegiatan',
                        'kategori' => 'Wajib',
                        'format' => 'PDF KAK & Undangan',
                        'keterangan' => 'Memuat latar belakang, jadwal acara, materi paparan, dan rincian alokasi jam pelajaran (JP) narasumber.',
                    ],
                    [
                        'no' => 3,
                        'nama' => 'Daftar Hadir / Presensi Peserta & Narasumber',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Daftar Hadir Asli',
                        'keterangan' => 'Daftar hadir bertandatangan lengkap seluruh peserta dan narasumber pada setiap sesi kegiatan.',
                    ],
                    [
                        'no' => 4,
                        'nama' => 'Daftar Penerimaan Honorarium / Amprah Honor bertandatangan',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Amprah Honor',
                        'keterangan' => 'Daftar tanda terima honor yang mencantumkan nama, NIP/NIK, NPWP, jumlah bruto, potongan PPh 21, dan jumlah neto yang diterima.',
                    ],
                    [
                        'no' => 5,
                        'nama' => 'Laporan Hasil Kegiatan / Risalah / Notulensi & Dokumentasi Foto',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Laporan & Foto',
                        'keterangan' => 'Dokumentasi foto pelaksanaan kegiatan (menampilkan narasumber dan peserta) serta notulensi ringkas.',
                    ],
                    [
                        'no' => 6,
                        'nama' => 'Bukti Potong Pajak Penghasilan (PPh Pasal 21)',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Bukti Potong',
                        'keterangan' => 'Bukti potong PPh 21 sesuai tarif (ASN Gol IV: 15%, Gol III: 5%, Non-ASN sesuai ketentuan).',
                    ],
                ]
            ],
            'uang_persediaan' => [
                'nama' => 'Uang Persediaan & SPJ GU',
                'kode' => 'SPP-UP / SPP-GU / SPP-TU',
                'icon' => 'heroicon-o-credit-card',
                'deskripsi' => 'Kelengkapan berkas pengajuan Uang Persediaan (UP), Ganti Uang (GU), dan Tambahan Uang (TU) operasional kas kecil.',
                'items' => [
                    [
                        'no' => 1,
                        'nama' => 'Surat Permintaan Pembayaran UP / GU / TU dan SPM',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Asli Bertandatangan',
                        'keterangan' => 'Dokumen SPP-UP/GU/TU yang ditandatangani Bendahara Pengeluaran dan disahkan oleh PA/PPK.',
                    ],
                    [
                        'no' => 2,
                        'nama' => 'Surat Keputusan (SK) Penetapan Besaran Pagu Uang Persediaan BLUD',
                        'kategori' => 'Wajib (UP)',
                        'format' => 'PDF SK Direktur',
                        'keterangan' => 'Dasar penetapan pagu uang persediaan awal tahun anggaran yang ditetapkan oleh Direktur RS.',
                    ],
                    [
                        'no' => 3,
                        'nama' => 'Buku Kas Umum (BKU) dan Buku Pembantu Kas Pengeluaran',
                        'kategori' => 'Wajib (GU/TU)',
                        'format' => 'PDF BKU Periode Berjalan',
                        'keterangan' => 'Catatan mutasi penerimaan dan pengeluaran kas periode berjalan yang telah ditutup dan ditandatangani Bendahara.',
                    ],
                    [
                        'no' => 4,
                        'nama' => 'Surat Pertanggungjawaban (SPJ) Belanja Operasional yang disahkan PPTK',
                        'kategori' => 'Wajib (GU/TU)',
                        'format' => 'PDF SPJ Lengkap',
                        'keterangan' => 'Rekapitulasi SPJ belanja riil yang telah diverifikasi kelayakan buktinya.',
                    ],
                    [
                        'no' => 5,
                        'nama' => 'Kuitansi & Nota Riil Pembelian Belanja Operasional (ATK, Bahan, Konsumsi)',
                        'kategori' => 'Wajib (GU/TU)',
                        'format' => 'PDF Nota & Kuitansi',
                        'keterangan' => 'Nota asli pembelian barang operasional harian yang dilampiri tanda terima barang dan stempel toko.',
                    ],
                    [
                        'no' => 6,
                        'nama' => 'Berita Acara Pemeriksaan Kas (Opname Kas) dan Rekonsiliasi Bank',
                        'kategori' => 'Wajib (GU)',
                        'format' => 'PDF Berita Acara Kas',
                        'keterangan' => 'Hasil opname fisik kas tunai di brankas bendahara dan bukti saldo rekening koran bank.',
                    ],
                ]
            ],
            'pemeliharaan' => [
                'nama' => 'Pemeliharaan Sarpras & Alkes',
                'kode' => 'SPP-LS / GU Pemeliharaan',
                'icon' => 'heroicon-o-wrench-screwdriver',
                'deskripsi' => 'Kelengkapan berkas servis teknis, pemeliharaan gedung, kalibrasi alat kesehatan, dan penggantian suku cadang.',
                'items' => [
                    [
                        'no' => 1,
                        'nama' => 'Surat Permohonan Perbaikan / Work Order (WO) dari Unit Pengguna',
                        'kategori' => 'Wajib',
                        'format' => 'PDF WO Bertandatangan',
                        'keterangan' => 'Laporan permohonan servis awal dari kepala ruangan / unit terkait mengenai kondisi kerusakan sarana.',
                    ],
                    [
                        'no' => 2,
                        'nama' => 'Berita Acara Pemeriksaan Kerusakan Teknis oleh IPSRS / Teknisi',
                        'kategori' => 'Wajib',
                        'format' => 'PDF BAP Kerusakan',
                        'keterangan' => 'Hasil analisis teknis penyebab kerusakan dan rekomendasi penggantian suku cadang / servis spesialis.',
                    ],
                    [
                        'no' => 3,
                        'nama' => 'Surat Perintah Kerja (SPK) Servis / Perbaikan',
                        'kategori' => 'Wajib',
                        'format' => 'PDF SPK Resmi',
                        'keterangan' => 'Perintah kerja pelaksanaan perbaikan kepada penyedia jasa servis atau bengkel rekanan.',
                    ],
                    [
                        'no' => 4,
                        'nama' => 'Kuitansi & Faktur Pembelian Suku Cadang Asli beserta rincian jasa',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Kuitansi & Faktur',
                        'keterangan' => 'Rincian harga sparepart pengganti dan ongkos kerja servis yang telah disetujui.',
                    ],
                    [
                        'no' => 5,
                        'nama' => 'Berita Acara Serah Terima Pekerjaan Pemeliharaan / Uji Fungsi Alat',
                        'kategori' => 'Wajib',
                        'format' => 'PDF BAST Pemeliharaan',
                        'keterangan' => 'Pernyataan bahwa sarana / alat telah selesai diperbaiki, diuji fungsi, dan beroperasi normal kembali.',
                    ],
                    [
                        'no' => 6,
                        'nama' => 'Dokumentasi Foto Sebelum (0%), Pengerjaan (50%), dan Selesai (100%)',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Foto Visual',
                        'keterangan' => 'Foto fisik alat / sarana yang diperbaiki sebagai bukti riil pekerjaan.',
                    ],
                ]
            ],
            'obat_bmhp' => [
                'nama' => 'Belanja Obat, BMHP & Reagen',
                'kode' => 'SPP-LS Farmasi',
                'icon' => 'heroicon-o-beaker',
                'deskripsi' => 'Kelengkapan berkas pengadaan obat-obatan, Bahan Medis Habis Pakai (BMHP), reagen lab, dan gas medis.',
                'items' => [
                    [
                        'no' => 1,
                        'nama' => 'Surat Pesanan (SP) Obat/BMHP oleh Apoteker Penanggung Jawab / PPTK Farmasi',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Surat Pesanan Resmi',
                        'keterangan' => 'Surat Pesanan berkop resmi dengan nomor SIPA Apoteker kepada Pedagang Besar Farmasi (PBF) resmi.',
                    ],
                    [
                        'no' => 2,
                        'nama' => 'Surat Jalan / Delivery Order (DO) dari PBF Rekanan',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Surat Jalan Asli',
                        'keterangan' => 'Surat jalan yang mencantumkan nama obat, nomor batch, tanggal kedaluwarsa (ED), dan jumlah unit.',
                    ],
                    [
                        'no' => 3,
                        'nama' => 'Berita Acara Penerimaan & Pemeriksaan Barang Farmasi oleh Panitia/Pemeriksa',
                        'kategori' => 'Wajib',
                        'format' => 'PDF BAP Penerimaan',
                        'keterangan' => 'Pemeriksaan fisik kesesuaian obat, segel kemasan, suhu pengiriman (rantai dingin jika vaksin/reagen), dan ED.',
                    ],
                    [
                        'no' => 4,
                        'nama' => 'Faktur Tagihan / Invoice Asli Bermaterai Cukup dari PBF',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Faktur Asli',
                        'keterangan' => 'Faktur asli yang telah diverifikasi harga satuannya sesuai e-Katalog / kontrak pengadaan.',
                    ],
                    [
                        'no' => 5,
                        'nama' => 'Bukti Pencatatan Kartu Stok / Sistem SIMRS Farmasi',
                        'kategori' => 'Wajib',
                        'format' => 'PDF Laporan Masuk SIMRS',
                        'keterangan' => 'Bukti transaksi penerimaan barang telah tercatat secara elektronik ke dalam persediaan gudang farmasi.',
                    ],
                    [
                        'no' => 6,
                        'nama' => 'Faktur Pajak (e-Faktur PPN & PPh)',
                        'kategori' => 'Wajib',
                        'format' => 'PDF e-Faktur Resmi',
                        'keterangan' => 'e-Faktur pajak dari PBF yang telah divalidasi Ditjen Pajak.',
                    ],
                ]
            ],
        ];

        $currentData = $categories[$activeCategory] ?? $categories['gaji_asn'];
        $items = $currentData['items'];

        if (!empty($searchQuery)) {
            $query = strtolower($searchQuery);
            $items = array_filter($items, function($item) use ($query) {
                return str_contains(strtolower($item['nama']), $query) 
                    || str_contains(strtolower($item['keterangan']), $query)
                    || str_contains(strtolower($item['format']), $query);
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
                        @foreach($categories as $key => $cat)
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
