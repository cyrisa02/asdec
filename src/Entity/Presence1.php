<?php

namespace App\Entity;

use App\Repository\Presence1Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Presence1Repository::class)]
class Presence1
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'presence1s')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $users = null;

    #[ORM\ManyToOne(inversedBy: 'presence1s')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Timecard1 $timecards1 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isPresent = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTimecards1(): ?Timecard1
    {
        return $this->timecards1;
    }

    public function setTimecards1(?Timecard1 $timecards1): self
    {
        $this->timecards1 = $timecards1;

        return $this;
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
}
