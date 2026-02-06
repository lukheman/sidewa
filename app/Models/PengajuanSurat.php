<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_surat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tanggal_pengajuan',
        'status',
        'keterangan',
        'masyarakat_id',
        'jenis_surat_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_pengajuan' => 'date',
        ];
    }

    /**
     * Get the masyarakat who submitted the pengajuan
     */
    public function masyarakat(): BelongsTo
    {
        return $this->belongsTo(Masyarakat::class);
    }

    /**
     * Get the jenis surat
     */
    public function jenisSurat(): BelongsTo
    {
        return $this->belongsTo(JenisSurat::class);
    }

    /**
     * Get the user (admin) who validates the pengajuan
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if pengajuan is submitted (diajukan)
     */
    public function isSubmitted(): bool
    {
        return $this->status === 'diajukan';
    }

    /**
     * Check if pengajuan is in process
     */
    public function isInProcess(): bool
    {
        return $this->status === 'diproses';
    }

    /**
     * Check if surat is ready to pickup
     */
    public function isReadyToPickup(): bool
    {
        return $this->status === 'siap_ambil';
    }

    /**
     * Check if pengajuan is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === 'selesai';
    }

    /**
     * Check if pengajuan is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === 'ditolak';
    }
}
