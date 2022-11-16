<?php

namespace App\Http\Controllers;

use DB;

class ApiController
{
    public function index($response, DB $db)
    {
        $user = $db->table('users')->find(1);

        $response->getBody()->write(json_encode($user, JSON_PRETTY_PRINT));

        return $response;
    }
}
