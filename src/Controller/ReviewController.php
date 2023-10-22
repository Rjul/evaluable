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
        name: 'seller',
        requirements: [
            'slug' => '[a-zA-Z0-9-]+',
            'page' => '\d+'
        ]
    )]
    public function show(EntityManagerInterface $em, User $seller, int $page = 1)
    {
        $reviews = $em->getRepository(Review::class)->getPaginatedReviewsBySeller($seller, $page);
        $averageStars = $em->getRepository(Review::class)->getAverageStarsBySeller($seller);
        $totalReviews = $em->getRepository(Review::class)->getTotalReviewsBySeller($seller);
        $totalPages = ceil($totalReviews / Review::LIMIT_PER_PAGE);
        return $this->render('template.html.twig', [
            'seller' => $seller,
            'reviews' => $reviews,
            'averageStars' => $averageStars,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ]);
    }

}
