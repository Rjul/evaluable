<?php

namespace App\DataFixtures;

use App\Entity\Review;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TestingEvaluable extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $seller = $this->loadUsers($manager);
        $this->loadReviews($manager, $seller);
    }

    private function loadUsers(ObjectManager $manager): User
    {
        $seller = new User();
        $seller->setEmail('user-seller@gmail.com');
        $seller->setName('Seller');
        $seller->setPassword('password');
        $seller->setRoles(['ROLE_USER']);
        $manager->persist($seller);

        // create 20 users! Bam! use faker
        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setEmail('user' . $i . '@gmail.com');
            $user->setName('user-' . $i);
            $user->setPassword('password' . $i);
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);
        }

        $manager->flush();

        return $seller;
    }

    private function loadReviews(ObjectManager $manager, User $seller): void
    {
        // create 20 users! Bam! use faker
        for ($i = 0; $i < 50; $i++) {
            $reviews = new Review();
            $reviews->setContent('custom testing content ' . $i);
            $reviews->setStars(random_int(0, 5));
            $reviews->setUser($this->returnRandomUser($manager));
            $reviews->setSeller($seller);
            $manager->persist($reviews);
        }

        $manager->flush();
    }

    private function returnRandomUser(ObjectManager $manager): User
    {
        $users = $manager->getRepository(User::class)->findAll();
        $randomUser = $users[array_rand($users)];
        return $randomUser;
    }
}
