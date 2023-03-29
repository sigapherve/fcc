<?php

namespace App\Entity;

use App\Repository\ContrainteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContrainteRepository::class)
 */
class Contrainte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=product::class, inversedBy="contraintes")
     */
    private $product;

    /**
     * @ORM\ManyToMany(targetEntity=country::class, inversedBy="contraintes")
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $longdescription;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $enforcedate;

    public function __construct()
    {
        $this->product = new ArrayCollection();
        $this->country = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, product>
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(product $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product[] = $product;
        }

        return $this;
    }

    public function removeProduct(product $product): self
    {
        $this->product->removeElement($product);

        return $this;
    }

    /**
     * @return Collection<int, country>
     */
    public function getCountry(): Collection
    {
        return $this->country;
    }

    public function addCountry(country $country): self
    {
        if (!$this->country->contains($country)) {
            $this->country[] = $country;
        }

        return $this;
    }

    public function removeCountry(country $country): self
    {
        $this->country->removeElement($country);

        return $this;
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

    public function getLongdescription(): ?string
    {
        return $this->longdescription;
    }

    public function setLongdescription(?string $longdescription): self
    {
        $this->longdescription = $longdescription;

        return $this;
    }

    public function getEnforcedate(): ?\DateTimeInterface
    {
        return $this->enforcedate;
    }

    public function setEnforcedate(?\DateTimeInterface $enforcedate): self
    {
        $this->enforcedate = $enforcedate;

        return $this;
    }
}
