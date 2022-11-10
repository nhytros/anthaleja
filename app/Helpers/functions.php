<?php

use App\Models\Market\Product;
use Illuminate\Support\Facades\Request;


function multiexplode($delimiters = null, $input = "")
{
    $ready = str_replace($delimiters, '|', $input);
    return explode('|', $ready);
}

function genImage($width, $height)
{
    $id = rand(1, 1000);
    return "https://picsum.photos/id/{$id}/{$width}/{$height}.webp";
}

function getStatus($field, $reversed = false)
{
    $status = auth()->user()->character->$field;
    $val = [];
    if ($status <= 19) {
        $val = ['status' => $status ?? 0, 'color' => $reversed ? 'success' : 'secondary'];
    }
    if ($status >= 20) {
        $val = ['status' => $status, 'color' => $reversed ? 'primary' : 'danger'];
    }
    if ($status >= 40) {
        $val = ['status' => $status, 'color' => 'warning'];
    }
    if ($status >= 60) {
        $val = ['status' => $status, 'color' => $reversed ? 'danger' : 'primary'];
    }
    if ($status >= 80) {
        $val = ['status' => $status, 'color' => $reversed ? 'secondary' : 'success'];
    }
    return $val;
}

function athel()
{
    return config('ath.athel_symbol');
}

function duni()
{
    return config('ath.duni_symbol');
}

function toAthel($amount): string|array
{
    $data = [
        '1e63' => 'L',
        '1e60' => 'MI',
        '1e57' => 'N',
        '1e54' => 'O',
        '1e51' => 'PP',
        '1e48' => 'Q',
        '1e45' => 'R',
        '1e42' => 'S',
        '1e39' => 'TD',
        '1e36' => 'U',
        '1e33' => 'V',
        '1e30' => 'W',
        '1e27' => 'X',
        '1e24' => 'Y',
        '1e21' => 'Z',
        '1e18' => 'E',
        '1e15' => 'P',
        '1e12' => 'T',
        '1e9' => 'G',
        '1e6' => 'M',
        '1e3' => 'k',
        '1e0' => '',
    ];
    $decs = 2;
    $div = 1;
    $suffix = '';
    foreach ($data as $val => $sx) {
        if ($amount >= $val) {
            $suffix = $sx;
            $div = $val;

            break;
            // if ($amount <div 1e6) {
            //     $decs = 3;
            //     $div = 1;
            // }
        }
    }
    return athel() . ' ' . number_format($amount / $div, $decs, ';', ' ') . $suffix;
}

function fullAthel($amount)
{
    $athels = intval($amount);
    $duni = round(($amount - $athels) * 100, 0);
    return athel() . ' ' . $athels . ' ' . duni() . ' ' . $duni;
}

function gravatar($email, $size, $set = 'robohash')
{
    $hash = md5(strtolower($email));
    $url = "https://www.gravatar.com/avatar/{$hash}?r=g&d={$set}&s={$size}";
    return '<img src="' . $url . '" />';
}

function getIcon($group, $icon, $text = null)
{
    $addictions = '';
    if ($text) $icon .= ' me-1';

    $output = '<i class="' . $group . ' fa-' . $icon . '">' . '</i>';
    if ($text) $output .= $text;
    return $output;
}

function getActivePage($page)
{
    return Request::is($page) ? ' active' : '';
}

function required_field($label)
{
    return $label . ' <span class="text-danger">*</span>';
}

function randomColor()
{
    $a = dechex(rand(0, 255));
    $a = strlen($a == 1) ? '0' . $a : $a;
    $b = dechex(rand(0, 255));
    $b = strlen($b == 1) ? '0' . $b : $b;
    $c = dechex(rand(0, 255));
    $c = strlen($c == 1) ? '0' . $c : $c;
    return $a . $b . $c;
}

function genLicence($n)
{
    $even = '';
    $odd = '';
    $sum_odds = 0;
    $sum_evens = 0;
    $n .= '139';
    for ($c = 0; $c < strlen($n); $c++) {
        if ($c % 2 == 0) {
            $even .= $n[$c];
        } else {
            $odd .= $n[$c];
        }
    }
    $odds = str_split($odd);
    $evens = str_split($even);
    $sum_odds = $odds[0] + $odds[1] + $odds[2] + $odds[3] + $odds[4];
    $sum_evens += ($evens[0] * 2 > 9 ? ($evens[0] * 2) - 9 : $evens[0] * 2) +
        ($evens[1] * 2 > 9 ? ($evens[1] * 2) - 9 : $evens[1] * 2) +
        ($evens[2] * 2 > 9 ? ($evens[2] * 2) - 9 : $evens[2] * 2) +
        ($evens[3] * 2 > 9 ? ($evens[3] * 2) - 9 : $evens[3] * 2) +
        ($evens[4] * 2 > 9 ? ($evens[4] * 2) - 9 : $evens[4] * 2);
    $sum_all = $sum_odds + $sum_evens;
    $div = $sum_all % 10;
    $check = ($div == 0) ? 0 : 10 - $div;
    return $n . $check;
}

function getName($order, $u)
{
    switch (strtolower($order)) {
        case 'fl':
            $output = $u->first_name . ' ' . $u->last_name;
            break;
        case 'lf':
            $output = $u->last_name . ' ' . $u->first_name;
            break;
        case 'username':
            $output = $u->username;
            break;
    }
    return $output;
}
