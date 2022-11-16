<?php

namespace Boot\Foundation;

abstract class Kernel
{
    public $app;

    /**
     * Register application Bootstrap Loaders
     * 
     * @var array
     */
    public array $bootstrappers = [];

    public function __construct(&$app)
    {
        $this->app = $app;
        // $this->app->getContainer()->set(self::class, $this);

    }

    public function bootstrapApplication()
    {
        $app = $this->getApp();
        $kernel = $this->getKernel();
        $bootstrappers = $this->bootstrappers;

        Bootstrappers\Bootstrapper::setup($app, $kernel, $bootstrappers);
    }

    public function getKernel()
    {
        return $this;
    }

    // public static function bootstrap(App &$app)
    // {
    //     return new static($app);
    // }

    public static function getApp()
    {
        return $this->app;
    }
}
