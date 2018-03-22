<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 13.03.18
 * Time: 22:55
 */

namespace AppBundle\Subscribers;

use JMS\Serializer\EventDispatcher\ObjectEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Router;

class NoticePostSerializeSubscriber implements \JMS\Serializer\EventDispatcher\EventSubscriberInterface
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return [
            [
            'event' => 'serializer.post_serialize',
            'method' => 'onPostSerialize',
            'class' => 'AppBundle\\Entity\\Notice',
            'format' => 'json', // optional format
            'priority' => '0', // optional priority
        ]];
    }

    public function onPostSerialize(ObjectEvent $event)
    {
        $visitor = $event->getVisitor();
        $object = $event->getObject();
        $visitor->setData('createdAt', $object->getCreatedAt()->format("Y-m-d"));
        $visitor->setData('expiredAt', $object->getCreatedAt()->format("Y-m-d"));
        $visitor->setData('orderCreatedAt', $object->getOrder() != null ? $object->getOrder()->getCreatedAt()->format("Y-m-d") : null);
    }
}
