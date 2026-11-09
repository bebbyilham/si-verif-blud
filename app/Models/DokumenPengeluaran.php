<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class DokumenPengeluaran extends Model
{
    protected $guarded = [];

    // Status Constants — satu sumber kebenaran untuk seluruh aplikasi
    const STATUS_DRAFT = 'draft';

    const STATUS_DIAJUKAN = 'diajukan';

    const STATUS_DIVERIFIKASI = 'diverifikasi';

    const STATUS_DIKEMBALIKAN = 'dikembalikan';

    const STATUS_DISAHKAN = 'disahkan';

    const STATUS_DIBAYAR = 'dibayar';

    const STATUS_DIARSIPKAN = 'diarsipkan';

    const ALL_STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_DIAJUKAN,
        self::STATUS_DIVERIFIKASI,
        self::STATUS_DIKEMBALIKAN,
        self::STATUS_DISAHKAN,
        self::STATUS_DIBAYAR,
        self::STATUS_DIARSIPKAN,
    ];

    protected $casts = [
        'file_path' => 'array',
        'nominal' => 'float',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->kode_dokumen)) {
                $lastDoc = static::latest('id')->first();
                $nextId = $lastDoc ? $lastDoc->id + 1 : 1;
                $model->kode_dokumen = 'BLUD-'.date('Y-m').'-'.str_pad((string) $nextId, 4, '0', STR_PAD_LEFT);
            }

            if (empty($model->status)) {
                $model->status = self::STATUS_DIAJUKAN;
            }
        });

        static::created(function ($model) {
            // Hanya kirim notifikasi jika ada user yang login & dokumen langsung diajukan (bukan draft)
            if (! auth()->check() || $model->status === self::STATUS_DRAFT) {
                return;
            }

            $verifikators = User::role('verifikator')->get();

            if ($verifikators->isNotEmpty()) {
                Notification::make()
                    ->title('Dokumen Baru Diajukan')
                    ->body('Dokumen '.$model->kode_dokumen.' telah diajukan oleh PPTK dan menunggu verifikasi.')
                    ->success()
                    ->sendToDatabase($verifikators);
            }
        });
    }

    public function hasValidLampiran(): bool
    {
        $files = $this->file_path;
        if (is_string($files)) {
            $files = json_decode($files, true) ?? [];
        }

        foreach ((array) $files as $item) {
            if (is_array($item)) {
                if (! empty($item['file']) || ! empty($item['link_drive']) || ! empty($item['link'])) {
                    return true;
                }
            } elseif (is_string($item) && trim($item) !== '') {
                return true;
            }
        }

        return false;
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function pptk()
    {
        return $this->belongsTo(User::class, 'pptk_id');
    }

    public function verifikasis()
    {
        return $this->hasMany(Verifikasi::class, 'dokumen_id');
    }

    public function riwayatKoreksis()
    {
        return $this->hasMany(RiwayatKoreksi::class, 'dokumen_id');
    }

    public function pengesahans()
    {
        return $this->hasMany(Pengesahan::class, 'dokumen_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'dokumen_id');
    }

    public function auditTrails()
    {
        return $this->hasMany(AuditTrail::class, 'id_data_terdampak')
            ->where('tabel_terdampak', 'dokumen_pengeluarans');
    }
}
