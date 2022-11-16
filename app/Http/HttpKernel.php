<?php

namespace App\Http;

use Boot\Foundation\HttpKernel as Kernel;

class HttpKernel extends Kernel
{
    /**
     * Global Middleware
     * @var array
     */
    public array $middleware = [
        // Middleware\ExampleAfterMiddleWare::class,
        // Middleware\ExampleBeforeMiddleWare::class
    ];

    /**
     * Route Group Middleware
     */
    public array $middlewareGroups = [
        'api'   => [],
        'web'   => [],
        'admin' => [],
    ];
}
