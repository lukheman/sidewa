<?php

namespace App\Models;

use App\Enum\StatusPengaduan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'isi_pengaduan',
        'tanggal_pengaduan',
        'status',
        'masyarakat_id',
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
            'tanggal_pengaduan' => 'date',
            'status' => StatusPengaduan::class,
        ];
    }

    /**
     * Get the masyarakat who submitted the pengaduan
     */
    public function masyarakat(): BelongsTo
    {
        return $this->belongsTo(Masyarakat::class);
    }

    /**
     * Get the user (admin) who handles the pengaduan
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if pengaduan is pending
     */
    public function isPending(): bool
    {
        return $this->status === StatusPengaduan::PENDING;
    }

    /**
     * Check if pengaduan is in process
     */
    public function isInProcess(): bool
    {
        return $this->status === StatusPengaduan::PROSES;
    }

    /**
     * Check if pengaduan is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === StatusPengaduan::SELESAI;
    }

    /**
     * Check if pengaduan is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === StatusPengaduan::DITOLAK;
    }
}
