<?php

namespace App\Entity;

use App\Repository\AssignerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssignerRepository::class)]
class Assigner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'assigner', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $produit = null;

    #[ORM\ManyToOne(inversedBy: 'assigners')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Typeproduit $Typeproduit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    public function getTypeproduit(): ?Typeproduit
    {
        return $this->Typeproduit;
    }

    public function setTypeproduit(?Typeproduit $Typeproduit): static
    {
        $this->Typeproduit = $Typeproduit;

        return $this;
    }
}
