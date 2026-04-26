<?php

namespace Src;

use Error;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Auth\Auth;

class Application
{
    private Settings $settings;
    private Route $route;
    private Capsule $dbManager;
    private Auth $auth;
    private array $providers = [];
    private array $binds = [];

    public function __construct(Settings $settings, array $config = [])
    {
        $this->settings = $settings;
        $this->route = Route::single()->setPrefix($this->settings->getRootPath());
        $this->dbManager = new Capsule();
        $this->auth = new $this->settings->app['auth'];
        $this->dbRun();
        $this->auth::init(new $this->settings->app['identity']);

        $this->addProviders($config['providers'] ?? []);
        $this->registerProviders();
        $this->bootProviders();
    }

    public function addProviders(array $providers): void
    {
        foreach ($providers as $key => $class) {
            $this->providers[$key] = new $class($this);
        }
    }

    private function registerProviders(): void
    {
        foreach ($this->providers as $provider) {
            $provider->register();
        }
    }

    private function bootProviders(): void
    {
        foreach ($this->providers as $provider) {
            $provider->boot();
        }
    }

    public function bind(string $key, $value): void
    {
        $this->binds[$key] = $value;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->binds)) {
            return $this->binds[$key];
        }

        switch ($key) {
            case 'settings':
                return $this->settings;
            case 'route':
                return $this->route;
            case 'auth':
                return $this->auth;
        }
        throw new Error('Accessing a non-existent property');
    }

    private function dbRun()
    {
        $this->dbManager->addConnection($this->settings->getDbSetting());
        $this->dbManager->setEventDispatcher(new Dispatcher(new Container));
        $this->dbManager->setAsGlobal();
        $this->dbManager->bootEloquent();
    }

    public function run(): void
    {
        $this->route->start();
    }
}