<?php

namespace App\Entity;

use App\Repository\TypeproduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeproduitRepository::class)]
class Typeproduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    #[ORM\OneToMany(targetEntity: Assigner::class, mappedBy: 'Typeproduit', orphanRemoval: true)]
    private Collection $assigners;

    public function __construct()
    {
        $this->assigners = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Assigner>
     */
    public function getAssigners(): Collection
    {
        return $this->assigners;
    }

    public function addAssigner(Assigner $assigner): static
    {
        if (!$this->assigners->contains($assigner)) {
            $this->assigners->add($assigner);
            $assigner->setTypeproduit($this);
        }

        return $this;
    }

    public function removeAssigner(Assigner $assigner): static
    {
        if ($this->assigners->removeElement($assigner)) {
            // set the owning side to null (unless already changed)
            if ($assigner->getTypeproduit() === $this) {
                $assigner->setTypeproduit(null);
            }
        }

        return $this;
    }
}
