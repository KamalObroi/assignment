<?php

namespace Drupal\assignment\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use \Drupal\assignment\TimeZoneService;
use Symfony\Component\DependencyInjection\ContainerInterface;
class JsonDataController extends ControllerBase {
   private $timezoneservcie;
   public function __construct(TimeZoneService $timeZoneService) {
      $this->timezoneservcie = $timeZoneService;
    }
  
    public static function create(ContainerInterface $container) {
      return new static(
        $container->get('assignment.timezoneService')
      );
    }
   /**
   * Returns a render-able array for a test page.
   */
   public function getupdatedDateTime(){
      $currentTime = $this->timezoneservcie->getCurrentTime();
      $currentLocation = $this->timezoneservcie->getLocation();          
      return new JsonResponse(['time' => $currentTime, 'location' => $currentLocation]);
   }
}
