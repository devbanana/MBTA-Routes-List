<?php

namespace App;

/**
 * Integrates with MBTA API
 */
class MBTAAPI
{

    /**
     * Base URL for the API
     *
     * @var string
     */
    private $base;

    /**
     * Curl handle for the API requests
     *
     * @var resource
     */
    private $curl_handle;

    /**
     * Constructs the API object
     *
     * @return void
     */
    public function __construct()
    {

        $this->base = 'https://api-v3.mbta.com/';
        $this->curl_handle = curl_init();
    }

    /**
     * Destroys the curl handle on destruct
     *
     * @return void
     */
    public function __destruct()
    {
        if ($this->curl_handle) {
            curl_close($this->curl_handle);
        }
    }

    /**
     * Sends a request to the API endpoint
     *
     * @param string $endpoint The endpoint to request
     * @return object JSON response
     */
    public function call($endpoint)
    {

        curl_setopt($this->curl_handle, CURLOPT_URL, $this->base . $endpoint);
        curl_setopt($this->curl_handle, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($this->curl_handle);
        $response = json_decode($response);
        if ($response === null) {
            throw new \RuntimeException('JSON could not be decoded.');
        }

        return $response;
            }
}
