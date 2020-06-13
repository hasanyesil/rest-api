<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Order;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CustomerSubscriber implements EventSubscriberInterface
{
    private $token;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->token = $tokenStorage;
    }

    public function setCustomerFromToken(ViewEvent $event)
    {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($entity instanceof Order && $method == Request::METHOD_POST){
            $customer = $this->token->getToken()->getUser();
            $entity->setCustomer($customer);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.view' => ['setCustomerFromToken',EventPriorities::PRE_WRITE],
        ];
    }
}
