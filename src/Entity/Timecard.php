<?php

namespace App\Entity;

use App\Repository\TimecardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TimecardRepository::class)]
class Timecard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 190)]
    private ?string $responsable = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatedAt = null;

   

    

    

    /**
 	*This constructor is for the date
 	*/
 	
 	public function __construct()
    {
        $this->CreatedAt = new \DateTimeImmutable();
       
        
       
           
        
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
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    

   

   
}