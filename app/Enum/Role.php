<?php

namespace App\Enum;

enum Role: string
{
    case ADMIN = 'admin';
    case KEPALA_DESA = 'kepala_desa';
    case PELAYANAN = 'pelayanan';

    /**
     * Get all role values as array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get role label in Indonesian
     */
    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrator',
            self::KEPALA_DESA => 'Kepala Desa',
            self::PELAYANAN => 'Pelayanan',
        };
    }

    /**
     * Get role badge color
     */
    public function color(): string
    {
        return match ($this) {
            self::ADMIN => 'danger',
            self::KEPALA_DESA => 'primary',
            self::PELAYANAN => 'secondary',
        };
    }

    /**
     * Get role icon
     */
    public function icon(): string
    {
        return match ($this) {
            self::ADMIN => 'fas fa-user-shield',
            self::KEPALA_DESA => 'fas fa-user-tie',
            self::PELAYANAN => 'fas fa-user',
        };
    }
}
