<?php

namespace App\Models;

/**
 * Integrates with MBTA Route API for getting schedule
 */
class Schedule
{

    public $arrival_time;
    public $departure_time;
    public $drop_off_type;
    public $pickup_type;
    public $stop_sequence;
    public $stop_id;

    /**
     * Construct schedule from JSON object
     *
     * @param object $obj The JSON object
     */
    public function __construct($obj)
    {
        $this->arrival_time = new \DateTime($obj->attributes->arrival_time);
        $this->departure_time = new \DateTime($obj->attributes->departure_time);
        $this->drop_off_type = $obj->attributes->drop_off_type;
        $this->pickup_type = $obj->attributes->pickup_type;
        $this->stop_sequence = $obj->attributes->stop_sequence;
        $this->stop_id = $obj->relationships->stop->data->id;
    }

}
