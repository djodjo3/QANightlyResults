<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('duration'))
{
    function duration($duration = 0)
    {
        $hours = floor($duration / 3600);
        $minutes = floor(($duration / 60) % 60);
        $seconds = $duration % 60;
        return $hours.'h'.$minutes.'m'.$seconds.'s';
    }

    function format_duration($duration) {
        if ($duration == 0 || $duration == '') {
            return 0;
        }
        if ($duration < 1000) {
            return $duration.'ms';
        }
        if ($duration < 5000) { //< 5 s
            return round($duration/1000, 3).'s';
        }
        if ($duration < 60000) { // < 1 min
            return floor($duration/1000).'s';
        }
        $dt = new DateTime();
        $dt->add(new DateInterval('PT'.floor($duration/1000).'S'));
        $interval = $dt->diff(new DateTime());
        return $interval->format('%Im %Ss');

        /*if ($duration < 1000*60*60) { // < 1h
            $minutes = floor(($duration / 60000) % 60);
            $duration -= $minutes;
            $seconds = round($duration/1000, 3);
            return $minutes.':'.$seconds.'m';
        }*/

    }
}