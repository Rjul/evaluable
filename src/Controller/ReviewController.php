<?php

namespace App\Controller;

use App\Entity\Review;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class ReviewController extends AbstractController
{
    #[Route(
        '/avis-client/vendeur-{slug}/{page}',
        name: 'review_seller_show',
        requirements: [
            'slug' => '[a-zA-Z0-9-]+',
            'page' => '\d+'
        ]
    )]
    public function show(EntityManagerInterface $em, User $seller, int $page = 1)
    {
        $reviews = $em->getRepository(Review::class)->getBySeller($seller, $page);

        $averageStars = $em->getRepository(Review::class)->getAverageStarsBySeller($seller);

        return $this->render('review/show.html.twig', [
            'seller' => $seller,
            'reviews' => $reviews,
            'averageStars' => $averageStars,
            'currentPage' => $page
        ]);
    }

}
