<?php

namespace PingPong\HttpClient;

use GuzzleHttp;
use mysql_xdevapi\Exception;

class HttpClient
{
    private $client;

    private $BASE_URL = "https://mediamagic.dev";

    function __construct() {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => $this->BASE_URL,
        ]);
    }

    /**
     * @throws \Exception|GuzzleHttp\Exception\GuzzleException
     */
    function post(string $path, Mappable $body): array
    {
        try {
            $response = $this->client->post($path, [
                GuzzleHttp\RequestOptions::JSON => $body->toMap(),
            ]);

            if ($response->getStatusCode() > 399) {
                throw new \Exception("request failed with status: " + $response->getStatusCode());
            }

            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            throw new \Exception('failed to make post request');
        }
    }

    /**
     * @throws \Exception|GuzzleHttp\Exception\GuzzleException
     */
    function get(string $path): array {
        try {
            $response = $this->client->get($path);

            if ($response->getStatusCode() > 399) {
                throw new \Exception("request failed with status: "  + $response->getStatusCode());
            }

            return json_decode($this->getBody(), true);
        } catch (Exception $e) {
            throw new \Exception('failed to make get request');
        }
    }
}
