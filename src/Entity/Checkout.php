<?php

namespace App\Entity;

use App\Repository\CheckoutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CheckoutRepository::class)
 */
class Checkout
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="checkouts")
     */
    private $customer;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $checkoutdate;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="checkouts")
     */
    private $shipto;

    /**
     * @ORM\OneToMany(targetEntity=Cotation::class, mappedBy="Checkout")
     */
    private $cotations;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="Checkout")
     */
    private $products;

    public function __construct()
    {
        $this->cotations = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCheckoutdate(): ?\DateTimeInterface
    {
        return $this->checkoutdate;
    }

    public function setCheckoutdate(?\DateTimeInterface $checkoutdate): self
    {
        $this->checkoutdate = $checkoutdate;

        return $this;
    }

    public function getShipto(): ?Country
    {
        return $this->shipto;
    }

    public function setShipto(?Country $shipto): self
    {
        $this->shipto = $shipto;

        return $this;
    }

    /**
     * @return Collection<int, Cotation>
     */
    public function getCotations(): Collection
    {
        return $this->cotations;
    }

    public function addCotation(Cotation $cotation): self
    {
        if (!$this->cotations->contains($cotation)) {
            $this->cotations[] = $cotation;
            $cotation->setCheckout($this);
        }

        return $this;
    }

    public function removeCotation(Cotation $cotation): self
    {
        if ($this->cotations->removeElement($cotation)) {
            // set the owning side to null (unless already changed)
            if ($cotation->getCheckout() === $this) {
                $cotation->setCheckout(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCheckout($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCheckout() === $this) {
                $product->setCheckout(null);
            }
        }

        return $this;
    }
}
