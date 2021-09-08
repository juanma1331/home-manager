<?php
namespace App\Controller\Inventories;

use App\Repository\InventoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inventories/{slug}/details', name: 'inventories.details', methods: ['GET'])]
class Details extends AbstractController
{
    private InventoryRepository $inventoryRepository;

    public function __construct(InventoryRepository $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }

    public function __invoke(string $slug): Response
    {
        $inventory = $this->inventoryRepository->findOneBy(['slug' => $slug]);

        if (!$inventory) {
            $this->createNotFoundException('Inventory not found.');
        }

        return $this->render('inventories/details.html.twig', [
            'inventory' => $inventory
        ]);
    }
}
