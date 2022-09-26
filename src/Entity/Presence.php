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

    

    
}