<?php

/**
 * @file
 * Contains Drupal\assignment\Form\AssignmentConfigForm.
 */

namespace Drupal\assignment\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class AssignmentConfigForm extends ConfigFormBase {

   /**
   * {@inheritdoc}
   */
   public function getFormId() {
      return 'assinment_form';
   }

   /**
   * {@inheritdoc}
   */
   public function buildForm(array $form, FormStateInterface $form_state) {
      // Form constructor.
      $form = parent::buildForm($form, $form_state);   

      // Default settings.
      $config = $this->config('assignment.settings');

      $form['country'] = [
         '#type' => 'textfield',
         '#title' => $this->t('Country'),
         '#default_value' => $config->get('assignment.settings.country'),
         '#description' => $this->t('Enter country')
      ];
      $form['city'] = [
         '#type' => 'textfield',
         '#title' => $this->t('City'),
         '#default_value' => $config->get('assignment.settings.city'),
         '#description' => $this->t('Enter City')
      ];
      $form['timezone'] = [
         '#type' => 'select',
         '#options' => $this->timezones(),
         '#title' => $this->t('Timezone'),
         '#default_value' => $config->get('assignment.settings.timezone'),
         '#description' => $this->t('Select Timezone')
      ];
      return $form;
   }
   public function timezones(){
      return [
         '_none' => 'Select', 
         'America/Chicago' => 'America/Chicago',
         'America/New_York' => 'America/New_York',
         'Asia/Tokyo' => 'Asia/Tokyo',
         'Asia/Dubai' => 'Asia/Dubai',
         'Asia/Kolkata' => 'Asia/Kolkata',
         'Europe/Amsterdam' => 'Europe/Amsterdam',
         'Europe/Oslo' => 'Europe/Oslo',
         'Europe/London' => 'Europe/London',
      ];
   }

   /**
   * {@inheritdoc}
   */
   public function validateForm(array &$form, FormStateInterface $form_state) {

   }

   /**
   * {@inheritdoc}
   */
   public function submitForm(array &$form, FormStateInterface $form_state) {
      $config = $this->config('assignment.settings');
      $config->set('assignment.settings.country', $form_state->getValue('country'));
      $config->set('assignment.settings.city', $form_state->getValue('city'));
      $config->set('assignment.settings.timezone', $form_state->getValue('timezone'));
      $config->save();
      return parent::submitForm($form, $form_state);
   }

   /**
   * {@inheritdoc}
   */
   protected function getEditableConfigNames() {
      return [
         'assignment.settings',
      ];
   }
}