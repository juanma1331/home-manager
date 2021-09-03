<?php

namespace App\Controller\Inventory\Category;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('inventory/category/new', name: 'inventory.category.new', methods: ['GET'] )]
class GET_ShowNewForm extends AbstractController
{
    public function __invoke(): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        return $this->render('inventory/category/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}