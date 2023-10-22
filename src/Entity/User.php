<?php

namespace App\Entity;

use App\Entity\Interface\SlugableInterface;
use App\Entity\Trait\SlugableTrait;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface, SlugableInterface
{
    use SlugableTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    // name field
    #[ORM\Column(length: 180)]
    private string $name;

    #[ORM\Column]
    private array $roles = [];


    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * Relation with many wrote reviews
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Review::class)]
    private $advices;

    /**
     * Relation with many reviews received
     */
    #[ORM\OneToMany(mappedBy: 'seller', targetEntity: Review::class)]
    private $ratings;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * Return all reviews wrote by the user
     *
     * @return Review[]
     */
    public function getAdvices(): PersistentCollection
    {
        return $this->advices;
    }

    /**
     * Return all reviews received by the user
     *
     * @return Review[]
     */
    public function getRatings(): PersistentCollection
    {
        return $this->ratings;
    }

    /**
     * @param mixed $advices
     * @return User
     */
    public function setAdvices($advices)
    {
        $this->advices = $advices;
        return $this;
    }

    /**
     * @param mixed $ratings
     * @return User
     */
    public function setRatings($ratings)
    {
        $this->ratings = $ratings;
        return $this;
    }

    public function getFieldToSlug(): array
    {
        return ['name', 'id'];
    }

}
