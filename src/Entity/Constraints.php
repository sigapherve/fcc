<?php

namespace App\Entity;

use App\Repository\ConstraintsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConstraintsRepository::class)
 */
class Constraints
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $enforcedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="constraints")
     */
    private $product;

    /**
     * @ORM\ManyToMany(targetEntity=Country::class, inversedBy="constraints")
     */
    private $Country;

    public function __construct()
    {
        $this->product = new ArrayCollection();
        $this->Country = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEnforcedAt(): ?\DateTimeInterface
    {
        return $this->enforcedAt;
    }

    public function setEnforcedAt(?\DateTimeInterface $enforcedAt): self
    {
        $this->enforcedAt = $enforcedAt;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->product->removeElement($product);

        return $this;
    }

    /**
     * @return Collection<int, Country>
     */
    public function getCountry(): Collection
    {
        return $this->Country;
    }

    public function addCountry(Country $country): self
    {
        if (!$this->Country->contains($country)) {
            $this->Country[] = $country;
        }

        return $this;
    }

    public function removeCountry(Country $country): self
    {
        $this->Country->removeElement($country);

        return $this;
    }
}
