<?php

namespace PingPong\HttpClient;

use GuzzleHttp;
use GuzzleHttp\Client;
use mysql_xdevapi\Exception;

require 'vendor/autoload.php';



class HttpClient
{
    private Client $client;

    private string $BASE_URL = "https://mediamagic.dev";

    private string $API_KEY;

    function __construct(string $apiKey = "")
    {

        if ($apiKey === "") {
            $apiKey = getenv('X_PINGPONG_KEY');
        }
        $this->API_KEY = $apiKey;
        $this->client = new Client([
            'base_uri' => $this->BASE_URL,
        ]);
    }

    private function postRequestOpts(Mappable $body): array
    {
        return [
            GuzzleHttp\RequestOptions::JSON => $body->toMap(),
            GuzzleHttp\RequestOptions::HEADERS => [
                'x-mediamagic-key' => $this->API_KEY,
            ]
        ];
    }

    private function getRequestOpts(): array
    {
        return [
            GuzzleHttp\RequestOptions::HEADERS => [
                'x-mediamagic-key' => $this->API_KEY,
            ]
        ];
    }

    /**
     * @throws \Exception|GuzzleHttp\Exception\GuzzleException
     */
    function post(string $path, Mappable $body): array
    {
        try {
            if ($this->API_KEY == "") {
                throw new \Exception("X_PINGPONG_KEY missing");
            }
            $response = $this->client->post($path, $this->postRequestOpts($body));

            if ($response->getStatusCode() > 399) {
                throw new \Exception("request failed with status: " . $response->getStatusCode());
            }

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            throw new \Exception('failed to make post request: ' . $e->getMessage());
        }
    }

    /**
     * @throws \Exception|GuzzleHttp\Exception\GuzzleException
     */
    function get(string $path): array
    {
        try {
            if ($this->API_KEY == "") {
                throw new \Exception("X_PINGPONG_KEY missing");
            }
            $response = $this->client->get($path, $this->getRequestOpts());

            if ($response->getStatusCode() > 399) {
                throw new \Exception("request failed with status: " + $response->getStatusCode());
            }

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            throw new \Exception('failed to make get request: ' . $e->getMessage());
        }
    }
}
