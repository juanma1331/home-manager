<?php

namespace App\Controller\Inventories;

use App\Entity\Inventory;
use App\Form\InventoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inventories/new', name: 'inventories.new', methods: ['GET'])]
class GET_New extends AbstractController
{
    public function __invoke(): Response
    {
        $inventory = new Inventory();

        $form = $this->createForm(InventoryType::class, $inventory);

        return $this->render('inventories/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
