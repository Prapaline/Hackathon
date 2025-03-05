<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    #[ORM\Column]
    private ?int $phone = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Skill $skillid = null;

    /**
     * @var Collection<int, UserChantier>
     */
    #[ORM\OneToMany(targetEntity: UserChantier::class, mappedBy: 'user')]
    private Collection $userChantiers;

    



    public function __construct()
    {
        $this->chantier = new ArrayCollection();
        $this->userChantiers = new ArrayCollection();
    }

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
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
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

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getSkillid(): ?Skill
    {
        return $this->skillid;
    }

    public function setSkillid(?Skill $skillid): static
    {
        $this->skillid = $skillid;

        return $this;
    }

    /**
     * @return Collection<int, UserChantier>
     */
    public function getUserChantiers(): Collection
    {
        return $this->userChantiers;
    }

    public function addUserChantier(UserChantier $userChantier): static
    {
        if (!$this->userChantiers->contains($userChantier)) {
            $this->userChantiers->add($userChantier);
            $userChantier->setUser($this);
        }

        return $this;
    }

    public function removeUserChantier(UserChantier $userChantier): static
    {
        if ($this->userChantiers->removeElement($userChantier)) {
            // set the owning side to null (unless already changed)
            if ($userChantier->getUser() === $this) {
                $userChantier->setUser(null);
            }
        }

        return $this;
    }
    public function getChantiers(): array
{
    // Retourne un tableau simple de chantiers associés via UserChantier
    return array_map(fn($userChantier) => $userChantier->getChantier(), $this->userChantiers->toArray());
}


}
