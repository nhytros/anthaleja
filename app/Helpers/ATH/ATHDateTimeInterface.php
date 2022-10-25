<?php

namespace App\Helpers\ATH;

interface ATHDateTimeInterface
{
    /* Methods */
    // public function diff(ATHDateTimeInterface $targetObject, bool $absolute = false): ATHDateInterval;
    public function format(string $format): string;
    // public function getOffset(): int;
    // public function getTimestamp(): int;
    // public function getTimezone(): ATHDateTimeZone|false;
    // public function strtotime(string $datetime, ?int $baseTimeStamp = null): int|false;
    // public function __wakeup(): void;
}
