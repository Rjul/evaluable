<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[ORM\Table(name: '`review`')]
#[UniqueEntity(fields: ['id'])]
class Review
{

    /**
     * Store id of the review
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Store content of the review
     */
    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(message: 'Please enter a title.')]
    private string $content;

    /**
     * Store number of start of the review
     */
    #[ORM\Column(type: 'integer')]
    private int $stars;

    /**
     * Relation with one user
     */
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'advices')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    /**
     * Relation with one seller
     */
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'ratings')]
    #[ORM\JoinColumn(nullable: false)]
    private User $seller;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return content of the review
     *
     * @return string[]
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set content of the review
     *
     * @param string $content
     * @return Review
     */
    public function setContent(string $content): Review
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Return number of stars of the review
     *
     * @return int
     */
    public function getStars(): int
    {
        return $this->stars;
    }

    /**
     * Set number of stars of the review
     *
     * @param int $stars
     * @return Review
     */
    public function setStars(int $stars): Review
    {
        $this->stars = $stars;
        return $this;
    }

    /**
     * Return user who wrote the review
     *
     * @return User[]
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Set user who wrote the review
     *
     * @param User $user
     * @return Review
     */
    public function setUser(User $user): Review
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Return seller who is reviewed
     *
     * @return User[]
     */
    public function getSeller(): User
    {
        return $this->seller;
    }

    /**
     * Set seller who is reviewed
     *
     * @param User $seller
     * @return Review
     */
    public function setSeller(User $seller): Review
    {
        $this->seller = $seller;
        return $this;
    }

}
