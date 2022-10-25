<?php
$rdn = 951586057;       // Refundation Day Number
$adn = 2494800;         // Anthal Day Number
$yxe = 500;             // Years per Era
$mxy = 18;              // Months per Year
$dxy = 432;             // Days per Year
$dxe = $dxy * $yxe;     // Days per Era
$dxm = 24;              // Days per Month
$dxw = 7;               // Days per Week
$hxd = 28;              // Hours per Day
$ixh = 60;              // Minutes per Hour
$ixd = $ixh * $hxd;     // Minutes per Day
$sxi = 60;              // Seconds per Minute
$sxh = $sxi * $ixh;     // Seconds per Hour
$sxd = $sxh * $hxd;     // Seconds per Day
$sxw = $sxd * $dxw;     // Seconds per Week
$sxm = $sxd * $dxm;     // Seconds per Month
$sxy = $sxd * $dxy;     // Seconds per Year
$uxh = $sxh * 1e6;      // Microseconds per Hour
$long_max = 2147483647;
$long_min = (-$long_max - 1);

return [
    'version' => '0.0.6 ',
    'email_suffix' => '@anthaleja.ath',
    'athel_symbol' => chr(234) . chr(156) . chr(178),
    'duni_symbol' => chr(196) . chr(145),
    'long_max' => $long_max,
    'long_min' => $long_min,
    'latitude' =>   36.6752718333,
    'longitude' => -36.5165126665,

    'galaxy' => [
        'seed' => 368895,
        'g_radius' => 2100,
        'n_radius' => 12,
        'stellar_density' => .00371
    ],
    'nijl' => [
        'mass' => 1.086998615541,
        'age' => 4.2,
        'spacing_factor' => .3495,
    ],
    'time' => [
        'rdn' => $rdn,
        'adn' => $adn,
        'hes' => 2494800,
        'mxy' => $mxy,
        'yxe' => $yxe,
        'dxe' => $dxe, 'dxy' => $dxy, 'dxm' => $dxm, 'dxw' => $dxw,
        'hxd' => $hxd,
        'ixh' => $ixh, 'ixd' => $ixd, 'sxi' => $sxi,
        'sxi' => $sxi, 'sxh' => $sxh, 'sxd' => $sxd,
        'sxw' => $sxw, 'sxm' => $sxm, 'sxy' => $sxy,
        'uxh' => $uxh,
        'days' => ['0.Nijahr', '1.Majahr', '2.Bejahr', '3.Ĉejahr', '4.Dyjahr', '5.Fejahr', '6.Ĝejahr'],
        'months' => ['Ĝenamai', 'Febamai', 'Maramai', 'Apramai', 'Magamai', 'Ĝumai', 'Lumai', 'Agomai', 'Etamai', 'Oktamai', 'Enamai', 'Dekamai', 'Triamai', 'Kamai', 'Pentamai', 'Esamai', 'Ektamai', 'Beoktamai'],
    ],
];
