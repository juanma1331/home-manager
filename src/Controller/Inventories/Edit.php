<?php
namespace App\Controller\Inventories;

use App\Entity\Inventory;
use App\Form\InventoryType;
use App\Repository\InventoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inventories/edit/{slug}', name: 'inventories.edit', methods: ['GET', 'POST'])]
class Edit extends AbstractController
{
    private EntityManagerInterface $entityManager;

    private InventoryRepository $inventoryRepository;

    public function __construct(EntityManagerInterface $entityManager, InventoryRepository $inventoryRepository)
    {
        $this->entityManager = $entityManager;
        $this->inventoryRepository = $inventoryRepository;
    }

    public function __invoke(Request $request, string $slug): Response
    {
        $inventory = $this->inventoryRepository->findOneBy(['slug' => $slug]);

        if (!$inventory) {
            $this->createNotFoundException('Inventory not found.');
        }

        $form = $this->createForm(InventoryType::class, $inventory);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($inventory);
            $this->entityManager->flush();

            return $this->redirect($this->generateUrl('inventories.details', [
                'slug' => $inventory->getSlug()
            ]));
        }

        return $this->render('inventories/edit.html.twig', [
            'inventory' => $inventory,
            'form' => $form->createView()
        ]);
    }
}
