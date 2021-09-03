<?php

namespace App\Controller\Inventory;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inventory', name: 'inventory', methods: ['GET'])]
class GET_IndexInventory extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('inventory/index.html.twig');
    }
}
