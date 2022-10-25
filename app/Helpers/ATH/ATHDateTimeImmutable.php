<?php

namespace App\Helpers\ATH;

class ATHDateTimeImmutable implements ATHDateTimeInterface
{
    public function __construct(string $datetime = "now", ?ATHDateTimeZone $timezone = null)
    {
    }
    public function add(ATHDateInterval $interval): DateTimeImmutable
    {
    }
    public static function createFromFormat(string $format, string $datetime, ?ATHDateTimeZone $timezone = null): ATHDateTimeImmutable|false
    {
    }
    public static function createFromInterface(ATHDateTimeInterface $object): ATHDateTimeImmutable
    {
    }
    public static function createFromMutable(ATHDateTime $object): ATHDateTimeImmutable
    {
    }
    public static function getLastErrors(): array|false
    {
    }
    public function modify(string $modifier): ATHDateTimeImmutable|false
    {
    }
    public static function __set_state(array $array): ATHDateTimeImmutable
    {
    }
    public function setDate(int $year, int $month, int $day): ATHDateTimeImmutable
    {
    }
    public function setISODate(int $year, int $week, int $dayOfWeek = 1): ATHDateTimeImmutable
    {
    }
    public function setTime(int $hour, int $minute, int $second = 0, int $microsecond = 0): ATHDateTimeImmutable
    {
    }
    public function setTimestamp(int $timestamp): ATHDateTimeImmutable
    {
    }
    public function setTimezone(ATHDateTimeZone $timezone): ATHDateTimeImmutable
    {
    }
    public function sub(ATHDateInterval $interval): ATHDateTimeImmutable
    {
    }
    public function diff(ATHDateTimeInterface $targetObject, bool $absolute = false): ATHDateInterval
    {
    }
    public function format(string $format): string
    {
    }
    public function getOffset(): int
    {
    }
    public function getTimestamp(): int
    {
    }
    public function getTimezone(): ATHDateTimeZone|false
    {
    }
    public function __wakeup(): void
    {
    }
}
