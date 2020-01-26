<?php


class Car extends Automobile
{
    /**
     * {@inheritDoc}
     * @param $kilometers
     * @return mixed|string
     */
    public function speedUp($kilometers)
    {
        return "the Car has speeded up to {$kilometers} km/h";
    }

    /**
     * Checks one car tire
     * @param $tire
     * @return string
     */
    public function checkTire($tire)
    {
        return "the {$tire} was checked";
    }
}