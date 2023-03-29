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
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $qty;

    /**
     * @ORM\OneToMany(targetEntity=InvoicingMethod::class, mappedBy="Product")
     */
    private $invoicingMethods;

    /**
     * @ORM\ManyToMany(targetEntity=Constraints::class, mappedBy="product")
     */
    private $constraints;

    public function __construct()
    {
        $this->invoicingMethods = new ArrayCollection();
        $this->constraints = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMetalength(): ?float
    {
        return $this->metalength;
    }

    public function setMetalength(?float $metalength): self
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

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(?int $qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * @return Collection<int, InvoicingMethod>
     */
    public function getInvoicingMethods(): Collection
    {
        return $this->invoicingMethods;
    }

    public function addInvoicingMethod(InvoicingMethod $invoicingMethod): self
    {
        if (!$this->invoicingMethods->contains($invoicingMethod)) {
            $this->invoicingMethods[] = $invoicingMethod;
            $invoicingMethod->setProduct($this);
        }

        return $this;
    }

    public function removeInvoicingMethod(InvoicingMethod $invoicingMethod): self
    {
        if ($this->invoicingMethods->removeElement($invoicingMethod)) {
            // set the owning side to null (unless already changed)
            if ($invoicingMethod->getProduct() === $this) {
                $invoicingMethod->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Constraints>
     */
    public function getConstraints(): Collection
    {
        return $this->constraints;
    }

    public function addConstraint(Constraints $constraint): self
    {
        if (!$this->constraints->contains($constraint)) {
            $this->constraints[] = $constraint;
            $constraint->addProduct($this);
        }

        return $this;
    }

    public function removeConstraint(Constraints $constraint): self
    {
        if ($this->constraints->removeElement($constraint)) {
            $constraint->removeProduct($this);
        }

        return $this;
    }
}
