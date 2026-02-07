<?php

namespace App\Enum;

enum StatusPengajuanSurat: string
{
    case DIAJUKAN = 'diajukan';
    case DIPROSES = 'diproses';
    case SIAP_AMBIL = 'siap_ambil';
    case SELESAI = 'selesai';
    case DITOLAK = 'ditolak';

    /**
     * Get all status values as array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get status label in Indonesian
     */
    public function label(): string
    {
        return match ($this) {
            self::DIAJUKAN => 'Diajukan',
            self::DIPROSES => 'Diproses',
            self::SIAP_AMBIL => 'Siap Diambil',
            self::SELESAI => 'Selesai',
            self::DITOLAK => 'Ditolak',
        };
    }

    /**
     * Get status badge color
     */
    public function color(): string
    {
        return match ($this) {
            self::DIAJUKAN => 'secondary',
            self::DIPROSES => 'info',
            self::SIAP_AMBIL => 'primary',
            self::SELESAI => 'success',
            self::DITOLAK => 'danger',
        };
    }

    /**
     * Get status icon
     */
    public function icon(): string
    {
        return match ($this) {
            self::DIAJUKAN => 'fas fa-paper-plane',
            self::DIPROSES => 'fas fa-spinner',
            self::SIAP_AMBIL => 'fas fa-box',
            self::SELESAI => 'fas fa-check-circle',
            self::DITOLAK => 'fas fa-times-circle',
        };
    }
}
