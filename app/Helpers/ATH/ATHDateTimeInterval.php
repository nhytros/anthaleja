<?php

namespace App\Helpers\ATH;

class ATHDateTimeInterval
{
    public int $y, $m, $d, $h, $i, $s, $invert;
    public float $f;
    public mixed $days;
    public bool $from_string;
    public string $date_string;

    public function __construct()
    {
    }

    // public static function createFromDateString(string $datetime): ATHDateTimeInterval|false
    // {
    // }

    public function format(string $format): string
    {
        preg_match_all("/[A-Z]+|\d+/", $format, $fmtArray);
        $output = '';
        dump($fmtArray[0]);
        foreach ($fmtArray[0] as $fmt) {
            switch ($fmt) {
                case '%':
                    $output .= '%';
                    break;
                case 'Y':
                    $key = array_search('Y', $fmtArray[0]);
                    $output .= str_pad($fmtArray[0][$key - 1], 2, '0', STR_PAD_LEFT);
                    break;
                case 'y':
                    $key = array_search('y', $fmtArray[0]);
                    $output .= $fmtArray[0][$key - 1];
                    break;
                case 'M':
                    $key = array_search('M', $fmtArray[0]);
                    $output .= str_pad($fmtArray[0][$key - 1], 2, '0', STR_PAD_LEFT);
                    break;
                case 'm':
                    $key = array_search('m', $fmtArray[0]);
                    $output .= $fmtArray[0][$key - 1];
                    break;
                case 'D':
                    $key = array_search('D', $fmtArray[0]);
                    $output .= str_pad($fmtArray[0][$key - 1], 2, '0', STR_PAD_LEFT);
                    break;
                case 'd':
                    $key = array_search('d', $fmtArray[0]);
                    $output .= $fmtArray[0][$key - 1];
                    break;
                case 'a':
                    $output .= '';
                    break;
                case 'H':
                    $key = array_search('H', $fmtArray[0]);
                    $output .= str_pad($fmtArray[0][$key - 1], 2, '0', STR_PAD_LEFT);
                    break;
                case 'h':
                    $key = array_search('h', $fmtArray[0]);
                    $output .= $fmtArray[0][$key - 1];
                    break;
                case 'I':
                    $key = array_search('I', $fmtArray[0]);
                    $output .= str_pad($fmtArray[0][$key - 1], 2, '0', STR_PAD_LEFT);
                    break;
                case 'i':
                    $key = array_search('i', $fmtArray[0]);
                    $output .= $fmtArray[0][$key - 1];
                    break;
                case 'S':
                    $key = array_search('S', $fmtArray[0]);
                    $output .= str_pad($fmtArray[0][$key - 1], 2, '0', STR_PAD_LEFT);
                    break;
                case 's':
                    $key = array_search('s', $fmtArray[0]);
                    $output .= $fmtArray[0][$key - 1];
                    break;
                case 'F':
                    $key = array_search('F', $fmtArray[0]);
                    $output .= str_pad($fmtArray[0][$key - 1], 2, '0', STR_PAD_LEFT);
                    break;
                case 'f':
                    $key = array_search('f', $fmtArray[0]);
                    $output .= $fmtArray[0][$key - 1];
                    break;
                case 'R':
                    $key = array_search('R', $fmtArray[0]);
                    $val = $fmtArray[0][$key - 1];
                    $output .= ($val > 0) ? '+' : '-';
                    break;
                case 'r':
                    $key = array_search('m', $fmtArray[0]);
                    $val = $fmtArray[0][$key - 1];
                    $output .= ($val > 0) ? '' : '-';
                    break;
            }
        }
        return $output;
    }
}
