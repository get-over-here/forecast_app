<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\Forecast\OpenWeatherMap;
use App\Providers\Forecast\Provider;

class ForecastProvider extends ServiceProvider
{

    private $providers = [];

    private static $providersClasses = [
        'OpenWeatherMap' => OpenWeatherMap::class,
    ];

    public function __construct()
    {

        foreach (self::$providersClasses as $name => $class) {
            $this->providers[$name] = new $class();
        }
    }
}
