<?php

namespace App\Entity;

use App\Repository\RateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RateRepository::class)
 */
class Rate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=country::class, inversedBy="rates")
     */
    private $country;

    /**
     * @ORM\ManyToMany(targetEntity=invoiceplace::class, inversedBy="rates")
     */
    private $invoiceplace;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $amount;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $version;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active;

    public function __construct()
    {
        $this->country = new ArrayCollection();
        $this->invoiceplace = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, invoiceplace>
     */
    public function getInvoiceplace(): Collection
    {
        return $this->invoiceplace;
    }

    public function addInvoiceplace(invoiceplace $invoiceplace): self
    {
        if (!$this->invoiceplace->contains($invoiceplace)) {
            $this->invoiceplace[] = $invoiceplace;
        }

        return $this;
    }

    public function removeInvoiceplace(invoiceplace $invoiceplace): self
    {
        $this->invoiceplace->removeElement($invoiceplace);

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getVersion(): ?\DateTimeInterface
    {
        return $this->version;
    }

    public function setVersion(?\DateTimeInterface $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
