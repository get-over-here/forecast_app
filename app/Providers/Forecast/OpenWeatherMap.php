<?php

namespace App\Providers\Forecast;

use Illuminate\Support\Collection;
use App\Models\Location;

class OpenWeatherMap extends Provider
{
    protected $url = 'https://api.openweathermap.org/data/3.0/onecall?lat=%s&lon=%s&units=metric&exclude=minutely,daily,alerts&appid=%s';

    public function getForecast($response)
    {
        // @todo parse response
        // json_decode($response)
    }

    public function getUrl(Location $location): string
    {
        return sprintf($this->url, $location->latitude, $location->longitude, $this->apiKey);
    }
}
