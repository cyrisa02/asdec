<?php

namespace App\Entity;

use App\Repository\Timecard1Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Timecard1Repository::class)]
class Timecard1
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 190)]
    private ?string $responsable = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'timecard1s')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sport $sports = null;

    #[ORM\OneToMany(mappedBy: 'timecards1', targetEntity: Presence::class)]
    private Collection $presences;

    public function __construct()
    {
        $this->presences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResponsable(): ?string
    {
        return $this->responsable;
    }

    public function setResponsable(string $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSports(): ?Sport
    {
        return $this->sports;
    }

    public function setSports(?Sport $sports): self
    {
        $this->sports = $sports;

        return $this;
    }

    /**
     * @return Collection<int, Presence>
     */
    public function getPresences(): Collection
    {
        return $this->presences;
    }

    public function addPresence(Presence $presence): self
    {
        if (!$this->presences->contains($presence)) {
            $this->presences->add($presence);
            $presence->setTimecards1($this);
        }

        return $this;
    }

    public function removePresence(Presence $presence): self
    {
        if ($this->presences->removeElement($presence)) {
            // set the owning side to null (unless already changed)
            if ($presence->getTimecards1() === $this) {
                $presence->setTimecards1(null);
            }
        }

        return $this;
    }
}
