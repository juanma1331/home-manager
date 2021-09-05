<?php

namespace App\Controller\Inventories;

use App\Entity\Inventory;
use App\Form\InventoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inventories/create', name: 'inventories.new', methods: ['POST'])]
class GET_Create extends AbstractController
{
    public function __invoke(Request $request): Response
    {
        $inventory = new Inventory();

        $form = $this->createForm(InventoryType::class, $inventory);

        $form->handleRequest($request);


        return $this->redirect($this->generateUrl('inventories.index'));
    }
}
