<?php

namespace Tests\Feature;

use App\Filament\Resources\DokumenPengeluarans\DokumenPengeluaranResource;
use App\Filament\Widgets\DokumenChart;
use App\Models\Bidang;
use App\Models\DokumenPengeluaran;
use App\Models\JenisKesalahan;
use App\Models\RiwayatKoreksi;
use App\Models\User;
use App\Models\Verifikasi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class BlackboxTestingFollowupTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        foreach (['super_admin', 'admin', 'pptk', 'verifikator', 'ppk', 'bendahara', 'manajemen', 'rekanan'] as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }
    }

    public function test_pptk_can_save_document_as_draft_without_notifying_verifikator_and_hidden_from_verifikator(): void
    {
        $bidang = Bidang::create([
            'nama_bidang' => 'Keuangan',
            'pptk_penanggung_jawab' => 'PPTK Keuangan',
        ]);

        $pptk = User::factory()->create(['bidang_id' => $bidang->id]);
        $pptk->assignRole('pptk');

        $verifikator = User::factory()->create();
        $verifikator->assignRole('verifikator');

        $this->actingAs($pptk);

        $draftDoc = DokumenPengeluaran::create([
            'bidang_id' => $bidang->id,
            'pptk_id' => $pptk->id,
            'jenis_dokumen' => 'Belanja ATK',
            'sumber_dana' => 'BLUD',
            'nominal' => 2500000,
            'tanggal_ajuan' => now()->toDateString(),
            'status' => DokumenPengeluaran::STATUS_DRAFT,
            'file_path' => [],
        ]);

        $this->assertEquals(DokumenPengeluaran::STATUS_DRAFT, $draftDoc->status);
        $this->assertFalse($draftDoc->hasValidLampiran());
        $this->assertEquals(0, $verifikator->notifications()->count());

        // PPTK sees own draft
        $this->assertEquals(1, DokumenPengeluaranResource::getEloquentQuery()->count());

        // Verifikator does NOT see draft
        $this->actingAs($verifikator);
        $this->assertEquals(0, DokumenPengeluaranResource::getEloquentQuery()->count());
    }

    public function test_verified_or_approved_document_can_be_returned_for_revision_or_reverted(): void
    {
        $bidang = Bidang::create([
            'nama_bidang' => 'Pelayanan Medis',
            'pptk_penanggung_jawab' => 'PPTK Medis',
        ]);

        $pptk = User::factory()->create(['bidang_id' => $bidang->id]);
        $pptk->assignRole('pptk');

        $verifikator = User::factory()->create();
        $verifikator->assignRole('verifikator');

        $jenisKesalahan = JenisKesalahan::create([
            'nama_kesalahan' => 'Dokumen tidak lengkap',
            'deskripsi' => 'Berkas kurang',
        ]);

        $doc = DokumenPengeluaran::create([
            'bidang_id' => $bidang->id,
            'pptk_id' => $pptk->id,
            'jenis_dokumen' => 'Belanja Obat',
            'sumber_dana' => 'BLUD',
            'nominal' => 10000000,
            'tanggal_ajuan' => now()->toDateString(),
            'status' => DokumenPengeluaran::STATUS_DIVERIFIKASI,
            'file_path' => [
                ['tipe_sumber' => 'upload', 'judul' => 'Kwitansi', 'file' => 'dokumen_pengeluaran/sample.pdf'],
            ],
        ]);

        $this->assertTrue($doc->hasValidLampiran());

        // Simulate returning a STATUS_DIVERIFIKASI document back to STATUS_DIKEMBALIKAN
        $this->actingAs($verifikator);

        Verifikasi::create([
            'dokumen_id' => $doc->id,
            'verifikator_id' => $verifikator->id,
            'hasil' => 'dikembalikan',
            'tanggal_verifikasi' => now(),
            'catatan' => 'Ditemukan kekurangan lampiran faktur pajak',
        ]);

        RiwayatKoreksi::create([
            'dokumen_id' => $doc->id,
            'versi_ke' => $doc->riwayatKoreksis()->count() + 1,
            'jenis_kesalahan_id' => $jenisKesalahan->id,
            'catatan_koreksi' => 'Ditemukan kekurangan lampiran faktur pajak',
            'tanggal_koreksi' => now(),
            'dikoreksi_oleh' => $verifikator->id,
        ]);

        $doc->update(['status' => DokumenPengeluaran::STATUS_DIKEMBALIKAN]);

        $this->assertEquals(DokumenPengeluaran::STATUS_DIKEMBALIKAN, $doc->fresh()->status);
        $this->assertEquals(1, $doc->riwayatKoreksis()->count());
    }

    public function test_dashboard_stats_and_chart_are_isolated_for_pptk_keuangan(): void
    {
        $bidangKeuangan = Bidang::create(['nama_bidang' => 'Keuangan', 'pptk_penanggung_jawab' => 'PPTK Keuangan']);
        $bidangMedis = Bidang::create(['nama_bidang' => 'Pelayanan Medis', 'pptk_penanggung_jawab' => 'PPTK Medis']);

        $pptkKeuangan = User::factory()->create(['bidang_id' => $bidangKeuangan->id]);
        $pptkKeuangan->assignRole('pptk');

        $pptkMedis = User::factory()->create(['bidang_id' => $bidangMedis->id]);
        $pptkMedis->assignRole('pptk');

        // Create 2 documents for PPTK Keuangan (1 diajukan, 1 diverifikasi) + 1 draft
        DokumenPengeluaran::create([
            'bidang_id' => $bidangKeuangan->id,
            'pptk_id' => $pptkKeuangan->id,
            'jenis_dokumen' => 'Belanja ATK Keuangan',
            'sumber_dana' => 'BLUD',
            'nominal' => 3000000,
            'tanggal_ajuan' => now()->subDays(2)->toDateString(),
            'status' => DokumenPengeluaran::STATUS_DIAJUKAN,
        ]);

        DokumenPengeluaran::create([
            'bidang_id' => $bidangKeuangan->id,
            'pptk_id' => $pptkKeuangan->id,
            'jenis_dokumen' => 'Belanja Jasa Audit',
            'sumber_dana' => 'BLUD',
            'nominal' => 15000000,
            'tanggal_ajuan' => now()->subDays(3)->toDateString(),
            'status' => DokumenPengeluaran::STATUS_DIVERIFIKASI,
        ]);

        DokumenPengeluaran::create([
            'bidang_id' => $bidangKeuangan->id,
            'pptk_id' => $pptkKeuangan->id,
            'jenis_dokumen' => 'Draft Belanja Keuangan',
            'sumber_dana' => 'BLUD',
            'nominal' => 1000000,
            'tanggal_ajuan' => now()->toDateString(),
            'status' => DokumenPengeluaran::STATUS_DRAFT,
        ]);

        // Create 1 document for PPTK Medis
        DokumenPengeluaran::create([
            'bidang_id' => $bidangMedis->id,
            'pptk_id' => $pptkMedis->id,
            'jenis_dokumen' => 'Belanja Obat Medis',
            'sumber_dana' => 'BLUD',
            'nominal' => 50000000,
            'tanggal_ajuan' => now()->subDay()->toDateString(),
            'status' => DokumenPengeluaran::STATUS_DISAHKAN,
        ]);

        $this->actingAs($pptkKeuangan);

        // Check DokumenChart only counts PPTK Keuangan's 2 non-draft documents
        $chart = new DokumenChart;
        $reflection = new \ReflectionMethod($chart, 'getData');
        $reflection->setAccessible(true);
        $chartData = $reflection->invoke($chart);

        $this->assertEquals(2, array_sum($chartData['datasets'][0]['data']));
        $this->assertEquals('Pengajuan Dokumen Bidang Keuangan', $chart->getHeading());
    }
}
