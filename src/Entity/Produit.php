<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(targetEntity: Associer::class, mappedBy: 'produit', orphanRemoval: true)]
    private Collection $associers;

    #[ORM\OneToOne(mappedBy: 'produit', cascade: ['persist', 'remove'])]
    private ?Assigner $assigner = null;

    public function __construct()
    {
        $this->associers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    /**
     * @return Collection<int, Associer>
     */
    public function getAssociers(): Collection
    {
        return $this->associers;
    }

    public function addAssocier(Associer $associer): static
    {
        if (!$this->associers->contains($associer)) {
            $this->associers->add($associer);
            $associer->setProduit($this);
        }

        return $this;
    }

    public function removeAssocier(Associer $associer): static
    {
        if ($this->associers->removeElement($associer)) {
            // set the owning side to null (unless already changed)
            if ($associer->getProduit() === $this) {
                $associer->setProduit(null);
            }
        }

        return $this;
    }

    public function getAssigner(): ?Assigner
    {
        return $this->assigner;
    }

    public function setAssigner(Assigner $assigner): static
    {
        // set the owning side of the relation if necessary
        if ($assigner->getProduit() !== $this) {
            $assigner->setProduit($this);
        }

        $this->assigner = $assigner;

        return $this;
    }
}
