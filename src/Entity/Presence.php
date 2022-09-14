<?php

namespace App\Entity;

use App\Repository\PresenceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PresenceRepository::class)]
class Presence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isPresent = null;

    #[ORM\ManyToOne(inversedBy: 'presences')]
    private ?User $users = null;

    #[ORM\ManyToOne(inversedBy: 'presences')]
    private ?Timecard $timecards = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsPresent(): ?bool
    {
        return $this->isPresent;
    }

    public function setIsPresent(?bool $isPresent): self
    {
        $this->isPresent = $isPresent;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getTimecards(): ?Timecard
    {
        return $this->timecards;
    }

    public function setTimecards(?Timecard $timecards): self
    {
        $this->timecards = $timecards;

        return $this;
    }
}
