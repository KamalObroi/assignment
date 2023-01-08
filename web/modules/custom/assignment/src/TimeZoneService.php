<?php

namespace Drupal\assignment;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Datetime\DrupalDateTime;
/**
 * Class TimeZoneService
 * @package Drupal\assignment\Services
 */
class TimeZoneService {

   protected $config;

   /**
      * TimeZoneService constructor.
      * @param ConfigFactoryInterface $config
      */
   public function __construct(ConfigFactoryInterface $config) {
      $this->config = $config;
   }
   public function getCurrentTime() {
      $date = new DrupalDateTime(date('Y-m-d H:i:s'), 'UTC');      
      $configTimeZone = $this->config->get('assignment.settings')->get('assignment.settings.timezone');
      $date->setTimezone(new \DateTimeZone($configTimeZone));
      return $date->format('jS M Y - g:i A');      
   }
   public function getLocation(){
      return [
         'country' => $this->config->get('assignment.settings')->get('assignment.settings.country'),
         'city' => $this->config->get('assignment.settings')->get('assignment.settings.city'),
         'timezone' => $this->config->get('assignment.settings')->get('assignment.settings.timezone')
      ];
   }
}