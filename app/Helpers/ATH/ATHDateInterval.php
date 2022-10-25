<?php

namespace App\Helpers\ATH;

class ATHDateInterval
{
    /**
     * Properties
     *
     * @var integer $y Numbers of years.
     * @var integer $m Numbers of months.
     * @var integer $d Numbers of days.
     * @var integer $h Numbers of hours.
     * @var integer $i Numbers of minutes.
     * @var integer $s Numbers of seconds.
     * @var float   $f Number of microseconds, as a fraction of a second.
     * @var integer $invert Is 1 if the interval represents a negative
     *              time period and 0 otherwise. See ATHDateInterval::format().
     * @var mixed   $days If the DateInterval object was created by
     *              ATHDateTimeImmutable::diff() or ATHDateTime::diff(),
     *              then this is the total number of days between the start
     *              and end dates. Otherwise, days will be false.
     */
    public int $y, $m, $d, $h, $i, $s, $invert;
    public float $f;
    public mixed $days;
    public bool $from_string;
    public string $date_string;

    /* Methods */
    public function __construct(string $duration)
    {
        preg_match_all("/[A-Z]+|\d+/", $duration, $fmtArray);
        $output = [];
        foreach ($fmtArray[0] as $interval) {
            switch (strtoupper($interval)) {
                case 'Y':
                    $key = array_search('Y', $fmtArray[0]);
                    $output['y'] = str_pad($fmtArray[0][$key - 1], 2, '0', STR_PAD_LEFT);
                    break;
                case 'M':
                    $key = array_search('M', $fmtArray[0]);
                    $output['m'] = str_pad($fmtArray[0][$key - 1], 2, '0', STR_PAD_LEFT);
                    break;
                case 'D':
                    $key = array_search('D', $fmtArray[0]);
                    $output['d'] = str_pad($fmtArray[0][$key - 1], 2, '0', STR_PAD_LEFT);
                    break;
                case 'H':
                    $key = array_search('H', $fmtArray[0]);
                    $output['h'] = str_pad($fmtArray[0][$key - 1], 2, '0', STR_PAD_LEFT);
                    break;
                case 'I':
                    $key = array_search('I', $fmtArray[0]);
                    $output['i'] = str_pad($fmtArray[0][$key - 1], 2, '0', STR_PAD_LEFT);
                    break;
                case 'S':
                    $key = array_search('S', $fmtArray[0]);
                    $output['s'] = str_pad($fmtArray[0][$key - 1], 2, '0', STR_PAD_LEFT);
                    break;
                case 'F':
                    $key = array_search('F', $fmtArray[0]);
                    $output['f'] = str_pad($fmtArray[0][$key - 1], 2, '0', STR_PAD_LEFT);
                    break;
            }
        }
        $this->output = $output;
    }

    public static function createFromDateString(string $datetime): ATHDateInterval|false
    {
        return false;
    }

    public function format(string $format): string
    {
        return '';
    }
}
