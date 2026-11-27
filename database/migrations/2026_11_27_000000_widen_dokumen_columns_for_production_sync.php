<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Memastikan panjang kolom jenis_dokumen, sumber_dana, kode_jenis, dan nama_jenis
     * sudah 255 karakter pada seluruh database (termasuk produksi yang dimigrasi sebelum
     * perubahan in-place pada migrasi awal).
     */
    public function up(): void
    {
        if (Schema::hasTable('dokumen_pengeluarans')) {
            Schema::table('dokumen_pengeluarans', function (Blueprint $table) {
                $table->string('jenis_dokumen', 255)->change();
                $table->string('sumber_dana', 255)->change();
            });
        }

        if (Schema::hasTable('jenis_dokumens')) {
            Schema::table('jenis_dokumens', function (Blueprint $table) {
                $table->string('kode_jenis', 255)->change();
                $table->string('nama_jenis', 255)->change();
            });
        }
    }

    /**
     * Tidak mempersempit kembali kolom untuk mencegah pemotongan data yang sudah tersimpan.
     */
    public function down(): void
    {
        //
    }
};
