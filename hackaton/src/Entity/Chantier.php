<?php

namespace App\Entity;

use App\Repository\ChantierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChantierRepository::class)]
class Chantier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $start_date = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $end_date = null;


    public function __construct()
    {
        $this->userChantiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getStartDate(): ?\DateTimeImmutable
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeImmutable $start_date): static
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeImmutable
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeImmutable $end_date): static
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
 * @var Collection<int, UserChantier>
 */
#[ORM\OneToMany(targetEntity: UserChantier::class, mappedBy: 'chantier')]
private Collection $userChantiers;

public function getUserChantiers(): Collection
{
    return $this->userChantiers;
}

public function addUserChantier(UserChantier $userChantier): static
{
    if (!$this->userChantiers->contains($userChantier)) {
        $this->userChantiers->add($userChantier);
        $userChantier->setChantier($this);
    }

    return $this;
}

public function removeUserChantier(UserChantier $userChantier): static
{
    if ($this->userChantiers->removeElement($userChantier)) {
        if ($userChantier->getChantier() === $this) {
            $userChantier->setChantier(null);
        }
    }

    return $this;
}

    public function getUsers(): array
    {
        // Retourne un tableau d'utilisateurs associés à ce chantier via UserChantier
        return array_map(fn($userChantier) => $userChantier->getUser(), $this->userChantiers->toArray());
    }


}
