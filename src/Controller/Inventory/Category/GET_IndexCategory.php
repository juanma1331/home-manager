<?php

namespace App\Controller\Inventory\Category;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inventory/category/index/{slug}', name: 'inventory.category.index', methods: ['GET'])]
class GET_IndexCategory extends AbstractController
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function __invoke(string $slug): Response
    {
        $category = $this->categoryRepository->findOneBy(['slug' => $slug]);
        return $this->render('inventory/category/index.html.twig', [
            'category' => $category
        ]);
    }
}