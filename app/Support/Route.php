<?php

namespace App\Support;

use Illuminate\Support\Str;

class Route
{
    public static $app;

    public static function setup(&$app)
    {
        self::$app = $app;
        return $app;
    }

    public static function __callStatic($verb, $params)
    {
        $app = self::$app;
        [$route, $action] = $params;
        // $app->$verb($route, $action);
        self::validation($route, $verb, $action);
        return is_callable($action)
            ? $app->$verb($route, $action)
            : $app->$verb($route, self::resolveViaController($action));
    }

    public static function resolveViaController($action)
    {
        $class      = Str::before($action, '@');
        $method     = Str::after($action, '@');
        $controller = config('routing.controllers.namespace') . $class;
        return [$controller, $method];
    }

    protected static function validation($route, $verb, $action)
    {
        $exception = "Unresolvable Route Callback/Controller action";
        $context   = json_encode(compact('route', 'action', 'verb'));
        $fails     = !((is_callable($action)) or (is_string($action) and Str::is("*@*", $action)));

        throw_when($fails, $exception . $context);
    }
}
