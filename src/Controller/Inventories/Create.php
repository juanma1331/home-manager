<?php

namespace App\Controller\Inventories;

use App\Entity\Inventory;
use App\Form\InventoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inventories/create', name: 'inventories.create', methods: ['GET','POST'])]
class Create extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(InventoryType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inventory = $form->getData();
            $this->entityManager->persist($inventory);
            $this->entityManager->flush();

            return $this->redirect($this->generateUrl('inventories'));
        }

        return $this->render('inventories/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
