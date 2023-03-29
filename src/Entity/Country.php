<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 */
class Country
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shortname;

    /**
     * @ORM\OneToMany(targetEntity=Checkout::class, mappedBy="shipto")
     */
    private $checkouts;

    public function __construct()
    {
        $this->checkouts = new ArrayCollection();
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

    public function getShortname(): ?string
    {
        return $this->shortname;
    }

    public function setShortname(?string $shortname): self
    {
        $this->shortname = $shortname;

        return $this;
    }

    /**
     * @return Collection<int, Checkout>
     */
    public function getCheckouts(): Collection
    {
        return $this->checkouts;
    }

    public function addCheckout(Checkout $checkout): self
    {
        if (!$this->checkouts->contains($checkout)) {
            $this->checkouts[] = $checkout;
            $checkout->setShipto($this);
        }

        return $this;
    }

    public function removeCheckout(Checkout $checkout): self
    {
        if ($this->checkouts->removeElement($checkout)) {
            // set the owning side to null (unless already changed)
            if ($checkout->getShipto() === $this) {
                $checkout->setShipto(null);
            }
        }

        return $this;
    }
}
