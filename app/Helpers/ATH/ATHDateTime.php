<?php

namespace App\Helpers\ATH;


class ATHDateTime implements ATHDateTimeInterface
{
    // Date Formats
    const ATH = "Y, d/m G:i:s";
    const ATOM = "Y-m-d\TH:i:sP";
    const COOKIE = "l, d-M-Y H:i:s T";
    const ISO8601 = "Y-m-d\TH:i:sO";
    const RFC822 = "D, d M y H:i:s O";
    const RFC850 = "l, d-M-y H:i:s T";
    const RFC1036 = "D, d M y H:i:s O";
    const RFC1123 = "D, d M Y H:i:s O";
    const RFC2822 = "D, d M Y H:i:s O";
    const RFC3339 = "Y-m-d\TH:i:sP";
    const RFC3339_EXTENDED = "Y-m-d\TH:i:s.vP";
    const RSS = "D, d M Y H:i:s O";
    const W3C = "Y-m-d\TH:i:sP";

    public function __construct(string|array $datetime = "now")
    {
        $rdn = config('ath.time.rdn');
        if ($datetime == 'now') {
            $this->eNow = time();
            $this->aSecs = $this->eNow - $rdn;
        } elseif (is_numeric($datetime)) {
            $this->aSecs = $datetime;
        } elseif (is_array($datetime)) {
            $y = $datetime[0];
            $m = $datetime[1] ?? 1;
            $d = $datetime[2] ?? 1;
            $h = $datetime[3] ?? 0;
            $i = $datetime[4] ?? 0;
            $s = $datetime[5] ?? 0;
            $this->aSecs = self::toADN($y, $m, $d, $h, $i, $s);
        } else {
            $dtArray = multiexplode(['-', ' ', ':'], $datetime);
            $year = $dtArray[0] ?? 5775;
            $month = $dtArray[1] ?? 1;
            $day = $dtArray[2] ?? 1;
            $hour = $dtArray[3] ?? 0;
            $minute = $dtArray[4] ?? 0;
            $second = $dtArray[5] ?? 0;
            $this->eSecs = self::toADN($year, $month, $day, $hour, $minute, $second);
        }
        $this->eNow = ($datetime == "now") ? time() : $datetime;
        $this->aDays = $this->aSecs / config('ath.time.sxd');
        $this->fYears = $this->aDays / config('ath.time.dxy');
        $this->adn = self::adn($this->aDays);
        $dec = $this->adn - intval($this->adn);
        $this->aYear = 5775;
        while ($this->aDays > config('ath.time.dxy')) {
            $this->aDays -= config('ath.time.dxy');
            $this->aYear++;
        }
        $this->aMonth = 1;
        while ($this->aDays > config('ath.time.dxm')) {
            $this->aDays -= config('ath.time.dxm');
            $this->aMonth += 1;
            if ($this->aMonth + 1 > config('ath.time.mxy')) {
                $this->aYear++;
                $this->aMonth = 1;
            }
        }
        $this->aDay = intval($this->aDays) + 1;
        $ssm = intval($this->aSecs % config('ath.time.sxd'));
        $this->aHour = intval($ssm / config('ath.time.sxh'));
        $tSecs = intval($ssm % config('ath.time.sxh'));
        $this->aMinute = intval($tSecs / config('ath.time.sxi'));
        $this->aSecond = $tSecs % config('ath.time.sxi');
    }

    public static function createFromFormat(string $format, string $datetime, ?ATHDateTimeZone $timezone = null): ATHDateTime|false
    {
        // $fmtArray = str_split($format);
        // foreach ($fmtArray as $fmt) {
        //     switch ($fmt) {
        //         case '!':
        //             $hour = 0;
        //             $minute = 0;
        //             $second = 0;
        //             break;
        //         case 'd':
        //         case 'j':
        //             break;
        //         case 'N':
        //             $output .= '';
        //             break;
        //         case 'S':
        //             $output .= 'x';
        //             break;
        //         case 'w':
        //             $output .= $dow;
        //             break;
        //         case 'z':
        //             $output .= self::dayOfYear();
        //             break;
        //         case 'F':
        //             $output .= config('ath.time.months')[$this->aMonth - 1];
        //             break;
        //         case 'm':
        //             $output .= str_pad($this->aMonth, 2, '0', STR_PAD_LEFT);
        //             break;
        //         case 'M':
        //             $output .= substr(config('ath.time.months')[$this->aMonth - 1], 0, -3);
        //             break;
        //         case 'n':
        //             $output .= $this->aMonth;
        //             break;
        //         case 't':
        //             $output .= config('ath.time.dxm');
        //             break;
        //         case 'X':
        //             $output .= ($this->aYear > 0) ? '+' : '-';
        //             $output .= str_pad($this->aYear, 4, '0', STR_PAD_LEFT);
        //             break;
        //         case 'x':
        //             if ($this->aYear >= 10000) {
        //                 $output .= '+';
        //             } elseif ($this->aYear <= -10000) {
        //                 $output .= '-';
        //             } else {
        //                 $output .= ($this->aYear > 0) ? '' : '-';
        //             }
        //             $output .= str_pad($this->aYear, 4, '0', STR_PAD_LEFT);

        //             break;
        //         case 'Y':
        //             $output .= str_pad($this->aYear, 4, '0', STR_PAD_LEFT);
        //             break;
        //         case 'y':
        //             $output .= str_pad($this->aYear % (intval($this->aYear / 100) * 100), 2, '0', STR_PAD_LEFT);
        //             break;
        //         case 'a':
        //             $output .= ($this->aHour > $hDay) ? $this->aHour - $hDay . 'pm' : $this->aHour . 'am';
        //             break;
        //         case 'A':
        //             $output .= ($this->aHour > $hDay) ? $this->aHour - $hDay . 'PM' : $this->aHour . 'AM';
        //             break;
        //         case 'B':
        //             $output .= '@' . intval(((($this->aMinute * config('ath.time.ixh')) + ($this->aHour * config('ath.time.sxh')))) / (config('ath.time.sxd') / 1000));
        //             break;
        //         case 'g':
        //             $output .= ($this->aHour > $hDay) ? $this->aHour - $hDay : $this->aHour;
        //             break;
        //         case 'G':
        //             $output .= str_pad($this->aHour, 2, '0', STR_PAD_LEFT);
        //             break;
        //         case 'h':
        //             $output .= str_pad(($this->aHour > $hDay) ? $this->aHour - $hDay : $this->aHour, 2, '0', STR_PAD_LEFT);
        //             break;
        //         case 'H':
        //             $output .= str_pad($this->aHour, 2, '0', STR_PAD_LEFT);
        //             break;
        //         case 'i':
        //             $output .= str_pad($this->aMinute, 2, '0', STR_PAD_LEFT);;
        //             break;
        //         case 's':
        //             $output .= str_pad($this->aSecond, 2, '0', STR_PAD_LEFT);
        //             break;
        //         case 'u':
        //             $output .= '';
        //             break;
        //         case 'v':
        //             $output .= '';
        //             break;
        //         case 'U':
        //             $output .= $this->eSecs;
        //             break;
        //         case 'c':
        //             $output .= self::format('Y-m-d') . 'T' . self::format('G:i:s') . '+00:00';
        //             break;
        //         case 'r':
        //             $output .= self::format(ATH) . ' ATH';
        //             break;
        //         default:
        //             $output .= $fmt;
        //             break;
        //     }
        // }
        // return $output;
        return false;
    }

    /**
     * createFromImmutable
     * Create From Immutable
     *
     * @param \DateTimeImmutable $datetime
     * @return self
     */
    // public static function createFromImmutable(\DateTimeImmutable $datetime) : self
    // {
    //     $dtobj = \DateTime::createFromImmutable($datetime);
    //     $obj = new self($dtobj);
    //     return $obj;
    // }
    // public static function createFromInterface(ATHDateTimeInterface $object): ATHDateTime
    // {
    // }

    /**
     * getLastErrors
     * Last Errors
     *
     * @return array
     */
    public static function getLastErrors(): array
    {
        return \DateTime::getLastErrors();
    }

    public function modify(string $modifier): ATHDateTime|false
    {
        $timestamp = $timestamp ?? "now";
        $time = new ATHDateTime($timestamp);
        $datetime = $time->format('U');

        $modArray = explode(' ', $modifier);
        $op = substr($modArray[0], 0, 1);
        $val = substr($modArray[0], 1, strlen($modArray[0]));
        switch (strtolower($modArray[1])) {
            case "second":
            case "seconds":
                $offset = 1;
                break;
            case "minute":
            case "minutes":
                $offset = config('ath.time.sxi');
                break;
            case "hour":
            case "hours":
                $offset = config('ath.time.sxh');
                break;
            case "day":
            case "days":
                $offset = config('ath.time.sxd');
                break;
            case "week":
            case "weeks":
                $offset = config('ath.time.sxw');
                break;
            case "month":
            case "months":
                $offset = config('ath.time.sxm');
                break;
            case "year":
            case "years":
                $offset = config('ath.time.sxy');
                break;
        };
        $offset *= $val;
        $time = new ATHDateTime($datetime);
        dump($op, $offset, $datetime, $time->format('c'));
        if ($op == '+') {
            $datetime += $offset;
        }
        if ($op == '-') {
            $datetime -= $offset;
        }
        $time = new ATHDateTime($datetime);
        dd($datetime, $time->format('c'));
    }

    // public static function __set_state(array $array): ATHDateTime
    // {
    // }

    /**
     * intervalParse
     *
     * @param [type] $interval
     * @return \DateInterval
     */
    public static function intervalParse($interval): \DateInterval
    {
        if (is_string($interval)) {
            if (preg_match('/^P([0-9]+[YMDW])*(T([0-9]+[HMS])+)?$/', $interval)) {
                $interval = new \DateInterval($interval);
            } else {
                $interval = \DateInterval::createFromDateString($interval);
            }
        }
        if (is_object($interval) && is_a($interval, \DateInterval::class)) {
            return $interval;
        }
        return new \DateInterval('P0D');
    }

    /**
     * timezoneParse
     *
     * @param [type] $timezone
     * @return \DateTimeZone
     */
    public static function timezoneParse($timezone): \DateTimeZone
    {
        if (is_int($timezone)) {
            if ($timezone >= -12 && $timezone <= 14) {
                $timezone = (string)$timezone;
            } else {
                $symbol = ($timezone < 0) ? '-' : '+';
                $hours = abs(floor($timezone / 3600));
                $minutes = floor($timezone / 60);
                $timezone = sprintf('%s%02d%02d', $symbol, $hours, $minutes);
            }
        }
        if (is_string($timezone)) {
            if (preg_match('/^(?P<symbol>[\+\-])?(?P<hour>[01]?[0-9])?[:]?(?P<min>[0-9][05])?$/', $timezone, $match)) {
                $symbol = empty($match['symbol']) ? '+' : $match['symbol'];
                $hour = (int)$match['hour'];
                $min = (int) ($match['min'] ?? 0);
                $formatted = sprintf('%s%02d%02d', $symbol, $hour, $min);
                $timezone = timezone_open($formatted);
            } else {
                $timezone = timezone_open($timezone);
            }
        }
        if (is_object($timezone) && is_a($timezone, \DateTimeZone::class)) {
            return $timezone;
        }
        return new \DateTimeZone('+0000');
    }

    /**
     * setDate
     * Sets the date
     *
     * @param integer $year
     * @param integer $month
     * @param integer $day
     * @return self
     */
    public function setDate(int $year, int $month, int $day): self
    {
        $this->obj->setDate($year, $month, $day);
        $this->time = (int)$this->obj->format('U');
        return $this;
    }

    /**
     * setISODate
     * Sets the ISO date
     *
     * @param integer $year
     * @param integer $week
     * @param integer $second
     * @return self
     */
    public function setISODate(int $year, int $week, int $second = 0): self
    {
        $this->obj->setISODate($year, $week, $second);
        $this->time = (int)$this->obj->format('U');
        return $this;
    }

    /**
     * setTime
     * Sets the time
     *
     * @param integer $hour
     * @param integer $minute
     * @param integer $second
     * @return self
     */
    public function setTime(int $hour, int $minute, int $second = 0): self
    {
        $this->obj->setTime($hour, $minute, $second);
        $this->time = (int)$this->obj->format('U');
        return $this;
    }

    /**
     * setTimestamp
     * Sets the timestamp
     *
     * @param integer $time
     * @return self
     */
    public function setTimestamp(int $time): self
    {
        $this->time = $time;
        $this->obj = new \DateTime();
        $this->obj->setTimestamp($time);
        $this->obj->setTimezone($this->tzobj);
        return $this;
    }

    /**
     * setTimezone
     * Sets the timezone
     *
     * @param [type] $timezone
     * @return self
     */
    public function setTimezone($timezone): self
    {
        $timezone = self::timezoneParse($timezone);
        if ($timezone) {
            $this->tzobj = $timezone;
            $this->obj->setTimezone($timezone);
        }
        return $this;
    }

    /**
     * add
     *
     * @param [type] $interval
     * @return self
     */
    public function add($interval): self
    {
        $interval = self::intervalParse($interval);
        $this->obj->add($interval);
        $this->time = (int)$this->obj->format('U');
        return $this;
    }

    /**
     * sub
     *
     * @param [type] $interval
     * @return self
     */
    public function sub($interval): self
    {
        $interval = self::intervalParse($interval);
        $this->obj->sub($interval);
        $this->time = (int)$this->obj->format('U');
        return $this;
    }

    /**
     * diff
     *
     * @param DateTimeInterface $datetime2
     * @param boolean $absolute
     * @return \DateInterval
     */
    public function diff(\DateTimeInterface $datetime2, bool $absolute = false): \DateInterval
    {
        return $this->obj->diff($datetime2, $absolute);
    }

    public function format(string $format): string
    {
        $fmtArray = str_split($format);
        $output = '';
        $hDay = config('ath.time.hxd') / 2;
        $dow = self::dayOfWeek($this->aSecs);
        foreach ($fmtArray as $fmt) {
            switch ($fmt) {
                case 'd':
                    $output .= str_pad($this->aDay, 2, '0', STR_PAD_LEFT);
                    break;
                case 'D':
                    $output .= substr(config('ath.time.days')[$dow], 0, 2);
                    break;
                case 'j':
                    $output .= $this->aDay;
                    break;
                case 'l':
                    $output .= config('ath.time.days')[$dow];
                    break;
                case 'N':
                    $output .= '';
                    break;
                case 'S':
                    $output .= 'x';
                    break;
                case 'w':
                    $output .= $dow;
                    break;
                case 'z':
                    $output .= self::dayOfYear();
                    break;
                case 'F':
                    $output .= config('ath.time.months')[$this->aMonth - 1];
                    break;
                case 'm':
                    $output .= str_pad($this->aMonth, 2, '0', STR_PAD_LEFT);
                    break;
                case 'M':
                    $output .= substr(config('ath.time.months')[$this->aMonth - 1], 0, -3);
                    break;
                case 'n':
                    $output .= $this->aMonth;
                    break;
                case 't':
                    $output .= config('ath.time.dxm');
                    break;
                case 'X':
                    $output .= ($this->aYear > 0) ? '+' : '-';
                    $output .= str_pad($this->aYear, 4, '0', STR_PAD_LEFT);
                    break;
                case 'x':
                    if ($this->aYear >= 10000) {
                        $output .= '+';
                    } elseif ($this->aYear <= -10000) {
                        $output .= '-';
                    } else {
                        $output .= ($this->aYear > 0) ? '' : '-';
                    }
                    $output .= str_pad($this->aYear, 4, '0', STR_PAD_LEFT);

                    break;
                case 'Y':
                    $output .= str_pad($this->aYear, 4, '0', STR_PAD_LEFT);
                    break;
                case 'y':
                    $output .= str_pad($this->aYear % (intval($this->aYear / 100) * 100), 2, '0', STR_PAD_LEFT);
                    break;
                case 'a':
                    $output .= ($this->aHour > $hDay) ? $this->aHour - $hDay . 'pm' : $this->aHour . 'am';
                    break;
                case 'A':
                    $output .= ($this->aHour > $hDay) ? $this->aHour - $hDay . 'PM' : $this->aHour . 'AM';
                    break;
                case 'B':
                    $output .= '@' . intval(((($this->aMinute * config('ath.time.ixh')) + ($this->aHour * config('ath.time.sxh')))) / (config('ath.time.sxd') / 1000));
                    break;
                case 'g':
                    $output .= ($this->aHour > $hDay) ? $this->aHour - $hDay : $this->aHour;
                    break;
                case 'G':
                    $output .= str_pad($this->aHour, 2, '0', STR_PAD_LEFT);
                    break;
                case 'h':
                    $output .= str_pad(($this->aHour > $hDay) ? $this->aHour - $hDay : $this->aHour, 2, '0', STR_PAD_LEFT);
                    break;
                case 'H':
                    $output .= str_pad($this->aHour, 2, '0', STR_PAD_LEFT);
                    break;
                case 'i':
                    $output .= str_pad($this->aMinute, 2, '0', STR_PAD_LEFT);;
                    break;
                case 's':
                    $output .= str_pad($this->aSecond, 2, '0', STR_PAD_LEFT);
                    break;
                case 'u':
                    $output .= '';
                    break;
                case 'v':
                    $output .= '';
                    break;
                case 'U':
                    $output .= $this->eSecs;
                    break;
                case 'c':
                    $output .= self::format('Y-m-d') . 'T' . self::format('G:i:s') . '+00:00';
                    break;
                case 'r':
                    $output .= self::ath() . ' ATH';
                    break;
                default:
                    $output .= $fmt;
                    break;
            }
        }
        return $output;
    }

    /**
     * getOffset
     * Gets the timezone offset
     *
     * @return integer
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * getTimestamp
     * Gets the timestamp
     *
     * @return integer
     */
    public function getTimestamp(): int
    {
        return $this->time;
    }

    /**
     * getTimeZone
     * Returns a \DateTimeZone
     *
     * @return \DateTimeZone
     */
    public function getTimeZone(): \DateTimeZone
    {
        return $this->tzobj;
    }

    public function __wakeup(): void
    {
    }



    /**
     * Returns a string formatted according to the given format string using the given
     * integer timestamp (Anthal timestamp) or the current Earth time if no timestamp is given.
     * In other words, timestamp is optional and defaults to the value of time().
     *
     * @param string $format
     * @param integer|null $timestamp
     * @return string
     */
    public function date(string $format, ?int $timestamp = null): string
    {
        $timestamp = $timestamp ?? "now";
        $time = new self($timestamp);
        return $time->format($format);
    }

    // public function strtotime(string $datetime): int|false
    // {
    //     if ($datetime == 'now') {
    //         return self::time();
    //     }
    //     if (strlen($datetime) > 3) {
    //         $format = explode(' ', $datetime);
    //     }
    // }

    /**
     * Return the Anthal timestamp according to the given date parameters.
     *
     * @param integer $year
     * @param integer $month
     * @param integer $day
     * @param integer $hour
     * @param integer $minute
     * @param integer $second
     * @return integer
     */
    public function date2ts(int $year, int $month, int $day, int $hour, int $minute, int $second): int
    {
        // $date =self::format('')
        $time = 0;
        $offset = 694329120;
        $sxd = config('ath.time.sxd');

        /* Calculate Year */
        $days = config('ath.time.dxy');
        $time += (($year - 1) * $days);

        /* Calculate Month */
        $days = config('ath.time.sxm');
        $time += (($month - 1) * $days);

        /* Calculate Day */
        $days = $day - 1;
        $time += $days * $sxd;

        /* Calculate Hour */
        $time += $hour * config('ath.time.sxh');
        /* Calculate Minutes */
        $time += $minute * config('ath.time.sxi');
        /* Calculate Seconds */
        $time += $second;

        /* Adjust with offset */
        $time += $offset;
        return $time;
    }

    public function mktime(int $hour, ?int $minute = null, ?int $second = null, ?int $month = null, ?int $day = null, ?int $year = null): int|false
    {
        $h = $hour;
        $i = $minute ?? 0;
        $s = $second ?? 0;
        $m = $month ?? 1;
        $d = $day ?? 1;
        if ($year) {
            if ($year < 100) {
                if ($year >= 0 || $year <= 12) {
                    $y = 5800 + $year;
                }
                if ($year >= 13 || $year <= 99) {
                    $y = 5700 + $year;
                }
            }
        }
        return false;
    }

    public function dayOfWeek($timestamp = 0)
    {
        $sxd = config('ath.time.sxd');
        $dxw = config('ath.time.dxw');
        $dow = (floor($timestamp / $sxd) + 4) % $dxw;
        return $dow;
    }

    public function dayOfYear($timestamp = 0)
    {
        $doy = 0;
        $doy += (($this->aMonth - 1) * config('ath.time.dxm'));
        $doy += ($this->aDay - 1);
        return $doy;
    }

    public function time($zone = 'e'): int
    {
        if ($zone == 'e') {
            return time();
        } else {
            $time = new ATHDateTime();
            return $this->eSecs;
        }
    }

    public function century(int $year)
    {
        if ($year <= 0) {
            return '0 and negative years is not allow for a year';
        } elseif ($year <= 100) {
            return 1;
        } elseif ($year % 100 == 0) {
            return intval($year / 100);
        } else {
            return intval($year / 100) + 1;
        }
    }

    public function millenium(int $year)
    {
        if ($year <= 0) {
            return '0 and negative years is not allow for a year';
        } elseif ($year <= 1000) {
            return 1;
        } elseif ($year % 1000 == 0) {
            return intval($year / 1000);
        } else {
            return intval($year / 1000) + 1;
        }
    }

    public function adn($days)
    {
        return $days + config('ath.time.adn');
    }

    public function toADN(int $y = 5775, int $m = 1, int $d = 1, int $h = 14, int $i = 0, int $s = 0)
    {
        $adn = 0;
        if ($m == config('ath.time.mxy')) {
            $m = config('ath.time.mxy');
            $y--;
        }
        $adn += ($y * config('ath.time.dxy'));
        $adn += ($m - 1) * config('ath.time.dxm');
        $adn += ($d - 1);
        $hms = ($h +
            $i / config('ath.time.ixh') +
            $s / config('ath.time.sxh')) /
            config('ath.time.hxd');
        $adn += $hms - .5;
        return $adn;
    }

    public function ADN2Date($adn): array|false
    {
        $adn += .5;
        $x = intval($adn);
        $f = $adn - $x;
        $f *= config('ath.time.sxd');
        $s = $f * config('ath.time.sxh');
        $d = intval($s / config('ath.time.sxd'));
        $sd = $s % config('ath.time.sxd');
        $h = intval($sd / config('ath.time.sxh'));
        $sh = $sd % config('ath.time.sxh');
        $i = intval($sh / config('ath.time.sxi'));
        $s = $sh % config('ath.time.sxi');
        $y = 0;
        while ($x > config('ath.time.dxy')) {
            $x -= config('ath.time.dxy');
            $y++;
        }
        $m = 1;
        while ($x > config('ath.time.dxm')) {
            $x -= config('ath.time.dxm');
            $m += 1;
            if ($m + 1 > config('ath.time.mxy')) {
                $y++;
                $m = 1;
            }
        }
        $d = intval($x) + 1;
        $ssm = intval($f % config('ath.time.sxd'));
        $h = intval($ssm / config('ath.time.sxh'));
        $tSecs = intval($ssm % config('ath.time.sxh'));
        $i = intval($tSecs / config('ath.time.sxi'));
        $s = $tSecs % config('ath.time.sxi');
        return [$y, $m, $d, $h, $i, $s];
    }

    public function now2jd()
    {
        $now = time();
        return ($now / 86400) + 2440587.5;
    }

    /**
     * ath
     * returns date in atom format
     *
     * @return void
     */
    public function ath()
    {
        return $this->format(self::ATH);
    }
}
