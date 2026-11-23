<?php

namespace Tests\Feature;

use App\Filament\Resources\Bidangs\BidangResource;
use App\Filament\Resources\DokumenPengeluarans\DokumenPengeluaranResource;
use App\Filament\Resources\DokumenPengeluarans\Pages\ListDokumenPengeluarans;
use App\Models\AuditTrail;
use App\Models\Bidang;
use App\Models\DokumenPengeluaran;
use App\Models\JenisKesalahan;
use App\Models\Pembayaran;
use App\Models\Pengesahan;
use App\Models\RiwayatKoreksi;
use App\Models\User;
use App\Models\Verifikasi;
use BezhanSalleh\FilamentShield\Facades\FilamentShield;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ResetDokumenPengeluaranTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel(Filament::getPanel('admin'));

        foreach (['super_admin', 'admin', 'pptk', 'verifikator'] as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        foreach ([
            'ViewAny:DokumenPengeluaran',
            'View:DokumenPengeluaran',
            'Create:DokumenPengeluaran',
            'Update:DokumenPengeluaran',
            'Delete:DokumenPengeluaran',
            'ResetData:DokumenPengeluaran',
        ] as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'web']);
        }

        Role::findByName('super_admin', 'web')->syncPermissions(Permission::all());
        Role::findByName('admin', 'web')->syncPermissions(
            Permission::where('name', '!=', 'ResetData:DokumenPengeluaran')->get()
        );
        Role::findByName('pptk', 'web')->syncPermissions([
            'ViewAny:DokumenPengeluaran',
            'View:DokumenPengeluaran',
            'Create:DokumenPengeluaran',
            'Update:DokumenPengeluaran',
        ]);
    }

    public function test_reset_data_permission_is_registered_in_filament_shield_for_dokumen_pengeluaran(): void
    {
        $dokumenPermissions = FilamentShield::getResourcePermissionsWithLabels(DokumenPengeluaranResource::class);
        $bidangPermissions = FilamentShield::getResourcePermissionsWithLabels(BidangResource::class);

        $this->assertArrayHasKey('ResetData:DokumenPengeluaran', $dokumenPermissions);
        $this->assertEquals('Reset Data', $dokumenPermissions['ResetData:DokumenPengeluaran']);
        $this->assertArrayNotHasKey('ResetData:Bidang', $bidangPermissions);
    }

    public function test_user_without_reset_data_permission_cannot_see_reset_action(): void
    {
        $admin = User::factory()->create([
            'password' => Hash::make('password123'),
            'status_aktif' => true,
        ]);
        $admin->assignRole('admin');

        $this->actingAs($admin);

        $this->assertFalse($admin->can('resetData', DokumenPengeluaran::class));

        Livewire::test(ListDokumenPengeluarans::class)
            ->assertActionHidden('reset_data_dokumen');
    }

    public function test_role_granted_reset_data_permission_via_shield_can_see_reset_action(): void
    {
        $adminRole = Role::findByName('admin', 'web');
        $adminRole->givePermissionTo('ResetData:DokumenPengeluaran');

        $admin = User::factory()->create([
            'password' => Hash::make('password123'),
            'status_aktif' => true,
        ]);
        $admin->assignRole('admin');

        $this->actingAs($admin);

        $this->assertTrue($admin->can('resetData', DokumenPengeluaran::class));

        Livewire::test(ListDokumenPengeluarans::class)
            ->assertActionVisible('reset_data_dokumen')
            ->assertActionDisabled('reset_data_dokumen');
    }

    public function test_reset_action_validates_confirmation_text_and_password(): void
    {
        $bidang = Bidang::create([
            'nama_bidang' => 'Keuangan',
            'pptk_penanggung_jawab' => 'PPTK Keuangan',
        ]);

        $superAdmin = User::factory()->create([
            'password' => Hash::make('secret123'),
            'status_aktif' => true,
        ]);
        $superAdmin->assignRole('super_admin');

        $this->actingAs($superAdmin);

        DokumenPengeluaran::create([
            'bidang_id' => $bidang->id,
            'pptk_id' => $superAdmin->id,
            'jenis_dokumen' => 'Belanja ATK',
            'sumber_dana' => 'BLUD',
            'nominal' => 1500000,
            'tanggal_ajuan' => now()->toDateString(),
            'status' => DokumenPengeluaran::STATUS_DRAFT,
            'file_path' => [],
        ]);

        Livewire::test(ListDokumenPengeluarans::class)
            ->assertActionVisible('reset_data_dokumen')
            ->assertActionEnabled('reset_data_dokumen')
            ->callAction('reset_data_dokumen', data: [
                'hapus_lampiran_fisik' => true,
                'hapus_notifikasi_terkait' => true,
                'alasan' => 'Alasan uji validasi reset data',
                'konfirmasi_teks' => 'salah',
                'password' => 'wrongpassword',
            ])
            ->assertHasActionErrors([
                'konfirmasi_teks',
                'password',
            ]);

        $this->assertEquals(1, DokumenPengeluaran::count());
    }

    public function test_authorized_user_can_reset_dokumen_pengeluaran_preserving_master_data_and_audit_trail(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('dokumen_pengeluaran/spj-sample.pdf', 'dummy pdf content');
        Storage::disk('public')->put('other/preserve.pdf', 'keep me');

        $bidang = Bidang::create([
            'nama_bidang' => 'Pelayanan Medis',
            'pptk_penanggung_jawab' => 'PPTK Medis',
        ]);

        $jenisKesalahan = JenisKesalahan::create([
            'nama_kesalahan' => 'Dokumen tidak lengkap',
            'deskripsi' => 'Lampiran belum sesuai',
        ]);

        $superAdmin = User::factory()->create([
            'password' => Hash::make('secret123'),
            'status_aktif' => true,
        ]);
        $superAdmin->assignRole('super_admin');

        $verifikator = User::factory()->create(['status_aktif' => true]);
        $verifikator->assignRole('verifikator');

        $this->actingAs($superAdmin);

        $dokumen = DokumenPengeluaran::create([
            'bidang_id' => $bidang->id,
            'pptk_id' => $superAdmin->id,
            'jenis_dokumen' => 'Belanja Obat',
            'sumber_dana' => 'BLUD',
            'nominal' => 12500000,
            'tanggal_ajuan' => now()->toDateString(),
            'status' => DokumenPengeluaran::STATUS_DIAJUKAN,
            'file_path' => [
                [
                    'tipe_sumber' => 'upload',
                    'judul' => 'SPJ Obat',
                    'file' => 'dokumen_pengeluaran/spj-sample.pdf',
                ],
                [
                    'tipe_sumber' => 'link',
                    'judul' => 'Lampiran Besar',
                    'link_drive' => 'https://drive.google.com/file/d/sample/view',
                ],
            ],
        ]);

        Verifikasi::create([
            'dokumen_id' => $dokumen->id,
            'verifikator_id' => $verifikator->id,
            'hasil' => 'lolos',
            'tanggal_verifikasi' => now(),
            'catatan' => 'Sesuai',
        ]);

        RiwayatKoreksi::create([
            'dokumen_id' => $dokumen->id,
            'versi_ke' => 1,
            'jenis_kesalahan_id' => $jenisKesalahan->id,
            'catatan_koreksi' => 'Perlu perbaikan tanda tangan',
            'tanggal_koreksi' => now(),
            'dikoreksi_oleh' => $verifikator->id,
        ]);

        Pengesahan::create([
            'dokumen_id' => $dokumen->id,
            'ppk_id' => $superAdmin->id,
            'tanggal_sah' => now(),
            'catatan' => 'Disahkan',
        ]);

        Pembayaran::create([
            'dokumen_id' => $dokumen->id,
            'bendahara_id' => $superAdmin->id,
            'tanggal_bayar' => now(),
            'nomor_spj' => 'BKU-001',
            'status_bayar' => 'lunas',
        ]);

        Notification::make()
            ->title('Dokumen Baru Diajukan')
            ->body('Dokumen '.$dokumen->kode_dokumen.' menunggu verifikasi.')
            ->sendToDatabase($verifikator);

        $this->assertGreaterThan(0, DB::table('notifications')->count());

        Livewire::test(ListDokumenPengeluarans::class)
            ->callAction('reset_data_dokumen', data: [
                'hapus_lampiran_fisik' => true,
                'hapus_notifikasi_terkait' => true,
                'alasan' => 'Pembersihan data uji coba sebelum operasional produksi',
                'konfirmasi_teks' => 'RESET DATA',
                'password' => 'secret123',
            ])
            ->assertHasNoActionErrors();

        // Seluruh tabel transaksi kosong
        $this->assertEquals(0, DokumenPengeluaran::count());
        $this->assertEquals(0, Verifikasi::count());
        $this->assertEquals(0, RiwayatKoreksi::count());
        $this->assertEquals(0, Pengesahan::count());
        $this->assertEquals(0, Pembayaran::count());

        // Lampiran lokal terhapus, file lain tetap aman
        Storage::disk('public')->assertMissing('dokumen_pengeluaran/spj-sample.pdf');
        Storage::disk('public')->assertExists('other/preserve.pdf');

        // Notifikasi terkait dokumen dibersihkan
        $this->assertEquals(0, DB::table('notifications')->count());

        // Data Master tetap utuh
        $this->assertEquals(1, Bidang::count());
        $this->assertEquals(1, JenisKesalahan::count());
        $this->assertEquals(2, User::count());

        // Jejak Audit tercatat permanen
        $this->assertTrue(
            AuditTrail::where('tabel_terdampak', 'dokumen_pengeluarans')
                ->where('user_id', $superAdmin->id)
                ->where('aksi', 'like', 'Reset Data: 1 dok dihapus%')
                ->exists()
        );

        // Penomoran kode dokumen baru mulai kembali dari 0001
        $newDokumen = DokumenPengeluaran::create([
            'bidang_id' => $bidang->id,
            'pptk_id' => $superAdmin->id,
            'jenis_dokumen' => 'Belanja ATK',
            'sumber_dana' => 'BLUD',
            'nominal' => 500000,
            'tanggal_ajuan' => now()->toDateString(),
            'status' => DokumenPengeluaran::STATUS_DRAFT,
            'file_path' => [],
        ]);

        $this->assertStringEndsWith('-0001', $newDokumen->kode_dokumen);
    }
}
