<?php

namespace Drupal\demoevent\EventSubscriber;

use Drupal\Core\Config\ConfigEvents;
use Drupal\Core\Messenger\MessengerTrait;
use Symfony\Component\HTTPKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HTTPKernel\Event\FilterResponseEvent;
use Drupal\Core\Config\ConfigCrudEvent;


class demoEventSubscriberExample implements EventSubscriberInterface{
    /**
     * {overrride}
     */
    public static function getSubscribedEvents(){
        $events[ConfigEvents::SAVE][]=array('onSavingConfig',800);
        //$events[KernelEvents::RESPONSE][]=['onRespond'];
        return $events;
    }

    /***
     * the subscribers
     */
    public function onSavingConfig(ConfigCrudEvent $event){
        //$this->messenger()->addStatus("hi hlw".$event->getConfig()->getName());
        drupal_set_message("working".$event->getConfig()->getName());

    }
    public function onRespond(FilterResponseEvent $event){
        drupal_set_message("working");

    }
}