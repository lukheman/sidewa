<?php

namespace App\Enum;

enum StatusPengajuanSurat: string
{
    case PENDING = 'pending';
    case DIPROSES = 'diproses';
    case DISETUJUI = 'disetujui';
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
            self::DIPROSES => 'Diproses',
            self::DISETUJUI => 'Disetujui',
            self::DITOLAK => 'Ditolak',
        };
    }

    /**
     * Get status badge color
     */
    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'secondary',
            self::DIPROSES => 'info',
            self::DISETUJUI => 'success',
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
            self::DIPROSES => 'fas fa-spinner',
            self::DISETUJUI => 'fas fa-check-circle',
            self::DITOLAK => 'fas fa-times-circle',
        };
    }
}
