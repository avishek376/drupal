<?php

namespace Drupal\time_location\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\time_location\services\TimeService;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "time_zone_block",
 *   admin_label = @Translation("Time Zone Block"),
 *   category = @Translation("Time Zone Block"),
 * )
 */

class TimeZoneBlock extends BlockBase implements ContainerFactoryPluginInterface{

  protected $timeData;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, TimeService $timeData){
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->timeData = $timeData;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('time_location.timeService')
    );
  }


  /**
   * {@inheritdoc}
   */
  public function build() {
    //\Drupal::logger('time_location')->error('current time '.$this->timeData->getTime());
    return [
      '#dateValue' => $this->timeData->getTime(),

      '#theme' => 'block-time-location',
      '#cache' => [
          'max-age' => 0,
      ],
    ];
  }

}