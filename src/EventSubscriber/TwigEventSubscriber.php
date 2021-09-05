<?php

namespace App\EventSubscriber;

use App\Repository\InventoryRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private Environment $twig;

    private InventoryRepository $inventoryRepository;

    public function __construct(Environment $twig, InventoryRepository $inventoryRepository)
    {
        $this->twig = $twig;
        $this->inventoryRepository = $inventoryRepository;
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $inventories = $this->inventoryRepository->findAll();
        $this->twig->addGlobal('inventories', $inventories);
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}
