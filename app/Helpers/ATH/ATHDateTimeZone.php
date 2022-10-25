<?php

namespace App\Helpers\ATH;

class ATHDateTimeZone
{
    public const ANTHAL = 1;
    public const ALL = 2047;

    public function __construct(string $timezone)
    {
    }
    public function getLocation(): array|false
    {
        return false;
    }
    public function getName(): string
    {
        return '';
    }
    public function getOffset(ATHDateTimeInterface $datetime): int
    {
        return 0;
    }
    public function getTransitions(int $timestampBegin = PHP_INT_MIN, int $timestampEnd = PHP_INT_MAX): array|false
    {
        return false;
    }
    public static function listAbbreviations(): array
    {
        return [];
    }
    public static function listIdentifiers(int $timezoneGroup = ATHDateTimeZone::ALL, ?string $countryCode = null): array
    {
        return [];
    }
}
