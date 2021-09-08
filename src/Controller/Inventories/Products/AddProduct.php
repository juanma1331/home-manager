<?php

namespace App\Controller\Inventories\Products;

use App\Entity\Inventory;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\InventoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inventories/{slug}/addProduct', name: 'inventories.products.addProduct', methods: ['GET','POST'])]
class AddProduct extends AbstractController
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
            $this->createNotFoundException('Inventory not Found');
        }

        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd('FORM SUBMITTED');
        }

        return $this->render('inventories/products/add.html.twig', [
           'inventory' => $inventory,
           'form' => $form->createView()
        ]);
    }
}
