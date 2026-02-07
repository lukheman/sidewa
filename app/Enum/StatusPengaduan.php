<?php

namespace App\Enum;

enum StatusPengaduan: string
{
    case PENDING = 'pending';
    case PROSES = 'proses';
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
            self::PENDING => 'Pending',
            self::PROSES => 'Diproses',
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
            self::PENDING => 'warning',
            self::PROSES => 'info',
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
            self::PENDING => 'fas fa-clock',
            self::PROSES => 'fas fa-spinner',
            self::SELESAI => 'fas fa-check-circle',
            self::DITOLAK => 'fas fa-times-circle',
        };
    }
}
