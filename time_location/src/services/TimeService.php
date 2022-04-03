<?php

namespace Drupal\time_location\services;

use Drupal\Core\Datetime\DateFormatter;
use Drupal\time_location\services\DrupalDateTime;

class TimeService{

    /**
     * a custom service to get the current time based on selected timezone
     */
    public function getTime(){
    
        $config = \Drupal::config('timezone.settings');

        $selectedTimeZone = $config->get('time_zone_value');

        date_default_timezone_set($selectedTimeZone);

        $getTimeZone = date_default_timezone_get();//just for checking
        $currentTime = date('jS F Y - h : i A');
        //\Drupal::logger('time_location')->error('city '.$config->get('city').' '.$getTimeZone.' > '.$currentTime); 
        return $currentTime;
    }
}