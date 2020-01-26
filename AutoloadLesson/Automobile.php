<?php


class Automobile implements Vehicle
{
    /**
     * {@inheritDoc}
     * @param $kilometers
     * @return mixed|string
     */
    public function speedUp($kilometers){
        return "the vehicle just moved {$kilometers} km/h";
    }

    /**
     * {@inheritDoc}
     * @param $speed
     * @return mixed|string
     */
    function stop($speed)
    {
        return "the vehicle just stopped at {$speed} km/h";
    }

    /**
     * {@inheritDoc}
     * @param $gear
     * @return mixed|string
     */
    function gearUp($gear)
    {
        return "the vehicle just changed to the {$gear} gear";
    }
}