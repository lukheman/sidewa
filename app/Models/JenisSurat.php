<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisSurat extends Model
{
    use HasFactory;

    protected $table = 'jenis_surat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_surat',
        'keterangan',
        'file_template',
        'form_fields',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'form_fields' => 'array',
    ];

    /**
     * Get pengajuan surats for this jenis surat
     */
    public function pengajuanSurats(): HasMany
    {
        return $this->hasMany(PengajuanSurat::class);
    }
}
