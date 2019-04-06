<?php

namespace Koff\Bundle\CdeBundle\EventSubscriber;

use Gedmo\Translatable\TranslatableListener;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Contracts\Service\ServiceSubscriberInterface;


class TranslatableSubscriber implements EventSubscriberInterface, ServiceSubscriberInterface
{
    /** @var ContainerInterface */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function onLateKernelRequest(GetResponseEvent $event): void
    {
        $this->container
            ->get(TranslatableListener::class)
            ->setTranslatableLocale($event->getRequest()->getLocale());
    }

    public function onConsoleCommand()
    {
        //TODO: Check translator ID and provide actual data here
        if ($this->container->has('translator')) {
            $this->container
                ->get(TranslatableListener::class)
                ->setTranslatableLocale($this->container->get('translator')->getLocale());
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => [
                'onLateKernelRequest',
                -10,
            ],
            ConsoleEvents::COMMAND => [
                'onConsoleCommand',
                -10
            ]
        ];
    }

    public static function getSubscribedServices(): array
    {
        return [
            TranslatableListener::class
        ];
    }
}