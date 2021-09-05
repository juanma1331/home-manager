<?php
namespace App\Controller\Inventories;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inventories', name: 'inventories', methods: ['GET'])]
class GET_Index extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('inventories/index.html.twig');
    }
}
