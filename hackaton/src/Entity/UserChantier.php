<?php

namespace App\Entity;

use App\Repository\UserChantierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserChantierRepository::class)]
class UserChantier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'userChantier')]
    private Collection $userid;

    /**
     * @var Collection<int, Chantier>
     */
    #[ORM\OneToMany(targetEntity: Chantier::class, mappedBy: 'userChantier')]
    private Collection $chantierid;

    #[ORM\Column]
    private ?\DateTimeImmutable $start_date = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $end_date = null;

    public function __construct()
    {
        $this->userid = new ArrayCollection();
        $this->chantierid = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserid(): Collection
    {
        return $this->userid;
    }

    public function addUserid(User $userid): static
    {
        if (!$this->userid->contains($userid)) {
            $this->userid->add($userid);
            $userid->setUserChantier($this);
        }

        return $this;
    }

    public function removeUserid(User $userid): static
    {
        if ($this->userid->removeElement($userid)) {
            // set the owning side to null (unless already changed)
            if ($userid->getUserChantier() === $this) {
                $userid->setUserChantier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Chantier>
     */
    public function getChantierid(): Collection
    {
        return $this->chantierid;
    }

    public function addChantierid(Chantier $chantierid): static
    {
        if (!$this->chantierid->contains($chantierid)) {
            $this->chantierid->add($chantierid);
            $chantierid->setUserChantier($this);
        }

        return $this;
    }

    public function removeChantierid(Chantier $chantierid): static
    {
        if ($this->chantierid->removeElement($chantierid)) {
            // set the owning side to null (unless already changed)
            if ($chantierid->getUserChantier() === $this) {
                $chantierid->setUserChantier(null);
            }
        }

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
}
