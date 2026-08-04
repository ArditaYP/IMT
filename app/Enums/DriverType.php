<?php

namespace App\Enums;

enum DriverType: string
{
    case SECURITY = 'security';
    case SIGNIFICANCE = 'significance';
    case CONNECTION = 'connection';
    case GROWTH = 'growth';
    case CONTRIBUTION = 'contribution';

    /**
     * Mendapatkan label human-readable dalam Bahasa Indonesia / English
     */
    public function label(): string
    {
        return match ($this) {
            self::SECURITY => 'Security',
            self::SIGNIFICANCE => 'Significance',
            self::CONNECTION => 'Connection',
            self::GROWTH => 'Growth',
            self::CONTRIBUTION => 'Contribution',
        };
    }

    /**
     * Mendapatkan semua nilai driver sebagai array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
