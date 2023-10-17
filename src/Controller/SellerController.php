<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class SellerController extends AbstractController
{
    #[Route('/', name: 'seller')]
    public function index()
    {
        return $this->render('template.html.twig', [

        ]);
    }
}
