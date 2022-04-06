<?php

namespace Drupal\demoevent\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class DemoEventSubscriberExample implements EventSubscriberInterface{
    /**
     * {overrride}
     */
    public static function getSubscribedEvents(){
        // $events[ConfigEvents::SAVE][]=array('onSavingConfig',800);
        // //$events[KernelEvents::RESPONSE][]=['onRespond'];
        // return $events;
        return [
            ConfigEvents::SAVE => 'onSavingConfig',
            ConfigEvents::DELETE => 'onRespond',
        ];
    }

    /***
     * the subscribers
     */
    public function onSavingConfig(ConfigCrudEvent $event){
        $config = $event->getConfig();
        \Drupal::messenger()->addStatus('Saved config: ' . $config->getName());

    }
    public function onRespond(ConfigCrudEvent $event){
        $config = $event->getConfig();
        \Drupal::messenger()->addStatus('Delete config: ' . $config->getName());

    }
}