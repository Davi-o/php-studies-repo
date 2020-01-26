<?php

/**
 * @author Davi Alves <alvesdelima.davi@gmail.com>
 * Interface Vehicle
 */
interface Vehicle
{
    /**
     * Speed up the vehicle
     * @param $speed
     * @return mixed
     */
    function speedUp($speed);

    /**
     * Stop the vehicle
     * @param $speed
     * @return mixed
     */
    function stop($speed);

    /**
     * Gear Up the vehicle
     * @param $gear
     * @return mixed
     */
    function gearUp($gear);
}