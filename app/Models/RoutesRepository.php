<?php

namespace App\Models;

use App\MBTAAPI;

/**
 * Manages routes
 */
class RoutesRepository
{

    /**
      * Field to sort by.
     */
    private $sort;

    /**
     * Query args for the request
     *
     * @var array
     */
    private $query_args;

    /**
     * Construct the routes repository
     *
     * @return void
     */
    public function __construct()
    {
        $this->query_args = [];
    }

    /**
     * Sort by some field
     *
     * @param string $sort Which field to sort by
     *
     * @return RoutesRepository for chaining
     */
    public function sortBy($sort)
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * Get the result
     *
     * Calls the MBTA API.
     *
     * @return array List of routes
     */
    public function get()
    {
        $query = [];
        if ($this->sort) {
            $query['sort'] = $this->sort;
        }

        $query = http_build_query($query);
        $mbta = new MBTAAPI();
        $response = $mbta->call('routes?' . $query);
        if (!isset($response->data)) {
            throw new \RuntimeException('Invalid response.');
        }

        // Create routes array
        $routes = [];
        foreach ($response->data as $route) {
            $routes[] = new Route($route);
        }

        return $routes;
    }
}
