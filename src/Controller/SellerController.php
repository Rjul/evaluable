<?php

namespace App\Controller;

use App\Entity\Review;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class SellerController extends AbstractController
{
    #[Route('/', name: 'seller')]
    public function index(EntityManagerInterface $em)
    {
        $seller = $em->getRepository(User::class)->findOneBy(['email' => 'user-seller@gmail.com']);
        return $this->render('template.html.twig', [
            'seller' => $seller,
            'averageStars' => $em->getRepository(Review::class)->getAverageStarsBySeller($seller)
        ]);
    }
}
