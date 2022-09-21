<?php

namespace App\Entity;

use App\Repository\SportUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SportUserRepository::class)]
class SportUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sportUsers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $users = null;

    #[ORM\ManyToOne(inversedBy: 'sportUsers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sport $sports = null;

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

    public function getSports(): ?Sport
    {
        return $this->sports;
    }

    public function setSports(?Sport $sports): self
    {
        $this->sports = $sports;

        return $this;
    }
}
