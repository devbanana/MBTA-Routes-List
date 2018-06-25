<?php

namespace App\Models;

use App\MBTAAPI;

/**
 * Integrates with MBTA Route API
 */
class Route
{

    // Route type constants
    const LIGHT_RAIL = 0;
    const HEAVY_RAIL = 1;
    const COMMUTER_RAIL = 2;
    const BUS = 3;
    const FERRY = 4;

    private $color;
    private $text_color;
    private $long_name;
    private $description;
    private $route_type;
    private $id;

    /**
     * Construct route from JSON object
     *
     * @param object $obj The JSON object
     */
    public function __construct($obj)
    {
        $this->color = $obj->attributes->color;
        $this->text_color = $obj->attributes->text_color;
        $this->route_type = $obj->attributes->type;
        $this->long_name = $obj->attributes->long_name;
        $this->description = $obj->attributes->description;
        $this->id = $obj->id;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getTextColor()
    {
        return $this->text_color;
    }

    public function getRouteType()
    {
        return $this->route_type;
    }

    public function getReadableRouteType()
    {
        switch ($this->route_type) {
            case self::LIGHT_RAIL:
            return 'Light Rail';
            break;
            case self::HEAVY_RAIL:
            return 'Heavy Rail';
            break;
            case self::COMMUTER_RAIL:
            return 'Commuter Rail';
            break;
            case self::BUS:
            return 'Bus';
            break;
            case self::FERRY:
            return 'Ferry';
            break;
        }
    }

    public function getLongName()
    {
        return $this->long_name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets schedule from route ID
     *
     * @return Schedule
     */
    public static function getSchedule($id)
    {
        $mbta = new MBTAAPI();
        $response = $mbta->call('schedules?filter[route]=' . $id);
        $schedules = [];
        foreach ($response->data as $item) {
            $schedules[] = new Schedule($item);
        }
        return $schedules;
    }

}
