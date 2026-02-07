<?php

namespace App\Enum;

enum Role: string
{
    case ADMIN = 'admin';
    case KADES = 'kades';
    case STAFF = 'staff';

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
            self::KADES => 'Kepala Desa',
            self::STAFF => 'Staff',
        };
    }

    /**
     * Get role badge color
     */
    public function color(): string
    {
        return match ($this) {
            self::ADMIN => 'danger',
            self::KADES => 'primary',
            self::STAFF => 'secondary',
        };
    }

    /**
     * Get role icon
     */
    public function icon(): string
    {
        return match ($this) {
            self::ADMIN => 'fas fa-user-shield',
            self::KADES => 'fas fa-user-tie',
            self::STAFF => 'fas fa-user',
        };
    }
}
