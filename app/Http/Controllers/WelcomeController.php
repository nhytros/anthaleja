<?php

namespace App\Http\Controllers;

use App\Support\View;

class WelcomeController
{
    public function index(View $view)
    {
        $name = 'Anthaleja Frontier';
        return $view('frontier.frontier');
    }
}
