<?php

namespace Drupal\assignment\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\assignment\TimeZoneService;

/**
 * Provides a block with a location from configuration.
 *
 * @Block(
 *   id = "assignment_location_block",
 *   admin_label = @Translation("Location block"),
 * )
 */
class Location extends BlockBase implements ContainerFactoryPluginInterface{

   /**
   * @var TimeZoneService $timezoneservice
   */
   private $timezoneservcie;

   /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\assignment\TimeZoneService $timezoneservice
   */
   public function __construct(array $configuration, $plugin_id, $plugin_definition, TimeZoneService $timezoneservice) {
      parent::__construct($configuration, $plugin_id, $plugin_definition);
      $this->timezoneservcie = $timezoneservice;
   }
   /**
   * {@inheritdoc}
   */
   public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
      return new static(
         $configuration,
         $plugin_id,
         $plugin_definition,
         $container->get('assignment.timezoneService')
      );
   }
   /**
      * {@inheritdoc}
   */
   public function build() {      
      $currentTime = $this->timezoneservcie->getCurrentTime();
      $currentLocation = $this->timezoneservcie->getLocation();
      \Drupal::service('page_cache_kill_switch')->trigger();
      return [
         '#theme' => 'location_block',
         '#data' => ['time' => $currentTime, 'location' => $currentLocation]         
      ];
   }

   /**
      * {@inheritdoc}
      */
   protected function blockAccess(AccountInterface $account) {
      return AccessResult::allowedIfHasPermission($account, 'access content');
   }

   /**
      * {@inheritdoc}
      */
   public function blockForm($form, FormStateInterface $form_state) {
      $config = $this->getConfiguration();
      return $form;
   }

   /**
      * {@inheritdoc}
      */
   public function blockSubmit($form, FormStateInterface $form_state) {
      $this->configuration['my_block_settings'] = $form_state->getValue('my_block_settings');
   }
}