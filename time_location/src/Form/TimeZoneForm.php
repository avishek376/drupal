<?php

namespace Drupal\time_location\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use \Drupal\Core\Datetime\DrupalDateTime;

class TimeZoneForm extends ConfigFormBase{

    /** 
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'timezone_settings';
    }

    /** 
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
            'timezone.settings',
        ];
    }

    /** 
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('timezone.settings');

        $form['country'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Country'),
        '#default_value' => $config->get('country'),
        ];  

        $form['city'] = [
        '#type' => 'textfield',
        '#title' => $this->t('City'),
        '#default_value' => $config->get('city'),
        ];  

        $form['time_zone'] = [
            '#type' => 'select',
            '#title' => $this->t('Chooses Timezone'),
            '#options' => [
                '0' => $this->t('Select Timezone'),
                '1' => $this->t('America/Chicago'),
                '2' => $this->t('America/New_York'),
                '3' => $this->t('Asia/Tokyo'),
                '4' => $this->t('Asia/Dubai'),
                '5' => $this->t('Asia/Kolkata'),
                '6' => $this->t('Europe/Amsterdam'),
                '7' => $this->t('Europe/Oslo'),
                '8' => $this->t('Europe/London'),
                ],
            '#default_value' => $config->get('time_zone_key'),
        ];

        
        return parent::buildForm($form, $form_state);
    }

    /** 
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        // Retrieve the configuration.
        $timeZoneKey = $form_state->getValue('time_zone');
        //\Drupal::logger('time_location')->error('key'.$timeZoneKey);
        $timeZoneVal = $form['time_zone']['#options'][$timeZoneKey];
        //\Drupal::logger('time_location')->error('value'.$timeZoneVal);

        $this->config('timezone.settings')
        // Set the submitted configuration setting.
        ->set('country', $form_state->getValue('country'))
        ->set('city', $form_state->getValue('city'))
        ->set('time_zone_key', $timeZoneKey)
        ->set('time_zone_value', $timeZoneVal)
        ->save();

        parent::submitForm($form, $form_state);

        
        
    }

}   