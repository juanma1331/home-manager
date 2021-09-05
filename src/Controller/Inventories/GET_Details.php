<?php
namespace App\Controller\Inventories;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inventories/details/{slug}', name: 'inventories.details', methods: ['GET'])]
class GET_Details extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('inventories/details.html.twig');
    }
}
