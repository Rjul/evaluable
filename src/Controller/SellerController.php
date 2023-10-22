<?php

namespace App\Controller;

use App\Entity\Review;
use App\Entity\User;
use App\Form\ReviewSellerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\isNull;

class SellerController extends AbstractController
{
    #[Route('/', name: 'seller')]
    public function index(Request $request, EntityManagerInterface $em)
    {
        $seller = $em->getRepository(User::class)->findOneBy(['email' => 'user-seller@gmail.com']);

        if (!is_null($this->getUser())) {
            $form = $this->createForm(ReviewSellerType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $review = $form->getData();
                $review->setUser($this->getUser());
                $review->setSeller($seller);
                $em->persist($review);
                $em->flush();
                $this->addFlash('success', 'Votre avis a bien été enregistré');

                return $this->redirectToRoute('seller');
            }

            return $this->render('template.html.twig', [
                'form' => $form->createView(),
                'seller' => $seller,
                'averageStars' => $em->getRepository(Review::class)->getAverageStarsBySeller($seller)
            ]);
        }

        return $this->render('template.html.twig', [
            'seller' => $seller,
            'averageStars' => $em->getRepository(Review::class)->getAverageStarsBySeller($seller)
        ]);
    }
}
