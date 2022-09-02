<?php

namespace App\Entity;

use App\Repository\ConditionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConditionRepository::class)]
#[ORM\Table(name: '`condition`')]
class Condition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isPresent = null;

    #[ORM\OneToOne(mappedBy: 'present', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\OneToOne(mappedBy: 'present', cascade: ['persist', 'remove'])]
    private ?Child $child = null;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setPresent(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getPresent() !== $this) {
            $user->setPresent($this);
        }

        $this->user = $user;

        return $this;
    }

    public function getChild(): ?Child
    {
        return $this->child;
    }

    public function setChild(?Child $child): self
    {
        // unset the owning side of the relation if necessary
        if ($child === null && $this->child !== null) {
            $this->child->setPresent(null);
        }

        // set the owning side of the relation if necessary
        if ($child !== null && $child->getPresent() !== $this) {
            $child->setPresent($this);
        }

        $this->child = $child;

        return $this;
    }
}
