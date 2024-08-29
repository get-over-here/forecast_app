<?php


namespace App\Providers\Forecast;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

abstract class Provider
{
    protected $url;
    protected $apiKey;
    protected $client;
    protected $requests;
    protected $threads = 2;

    public function __construct()
    {
        // @todo
        // $this->apiKey = config('forecast.api_key');
        $this->client = app(Client::class);
    }

    abstract public function getForecast($result);

    public function getData($locations): array
    {
        $client = new Client();
        $promises = [];

        foreach ($locations as $location)
        {
            $url = $this->getUrl($locations);
            $promise = $client->getAsync($url);
            $promises[] = $promise;
        }

        $results = Promise\settle($promises)->wait();

        $responses = [];

        foreach ($results as $result) {
            $responses[] = $this->getForecast($result->getBody());
        }

        return $responses;
    }

}
