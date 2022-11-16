<?php

namespace Boot\Foundation;

use Boot\Foundation\Bootstrappers\Bootstrapper;

class HttpKernel extends Kernel
{
    /**
     * Global Middleware
     * @var array
     */
    public array $middleware = [];

    /**
     * Route Group Middleware
     */
    public array $middlewareGroups = [
        'api'   => [],
        'web'   => [],
        'admin' => [],
    ];

    public array $bootstrap = [
        Bootstrappers\LoadEnvironmentVariables::class,
        Bootstrappers\LoadDebuggingPage::class,
        Bootstrappers\LoadAliases::class,
        Bootstrappers\LoadHttpMiddleware::class,
        Bootstrappers\LoadServiceProviders::class,
    ];
}
