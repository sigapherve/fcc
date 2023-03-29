<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $metalength;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $metawidth;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $metaheight;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $metaweight;

    /**
     * @ORM\ManyToMany(targetEntity=Contrainte::class, mappedBy="product")
     */
    private $contraintes;

    public function __construct()
    {
        $this->contraintes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMetalenght(): ?float
    {
        return $this->metalength;
    }

    public function setMetalenght(?float $metalength): self
    {
        $this->metalength = $metalength;

        return $this;
    }

    public function getMetawidth(): ?float
    {
        return $this->metawidth;
    }

    public function setMetawidth(?float $metawidth): self
    {
        $this->metawidth = $metawidth;

        return $this;
    }

    public function getMetaheight(): ?float
    {
        return $this->metaheight;
    }

    public function setMetaheight(?float $metaheight): self
    {
        $this->metaheight = $metaheight;

        return $this;
    }

    public function getMetaweight(): ?float
    {
        return $this->metaweight;
    }

    public function setMetaweight(?float $metaweight): self
    {
        $this->metaweight = $metaweight;

        return $this;
    }

    /**
     * @return Collection<int, Contrainte>
     */
    public function getContraintes(): Collection
    {
        return $this->contraintes;
    }

    public function addContrainte(Contrainte $contrainte): self
    {
        if (!$this->contraintes->contains($contrainte)) {
            $this->contraintes[] = $contrainte;
            $contrainte->addProduct($this);
        }

        return $this;
    }

    public function removeContrainte(Contrainte $contrainte): self
    {
        if ($this->contraintes->removeElement($contrainte)) {
            $contrainte->removeProduct($this);
        }

        return $this;
    }
}
