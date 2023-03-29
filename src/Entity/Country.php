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

    /**
     * @ORM\OneToMany(targetEntity=InvoicingMethod::class, mappedBy="Country")
     */
    private $invoicingMethods;

    /**
     * @ORM\OneToMany(targetEntity=Rate::class, mappedBy="Country")
     */
    private $Paymentplace;

    /**
     * @ORM\ManyToMany(targetEntity=Constraints::class, mappedBy="Country")
     */
    private $constraints;

    public function __construct()
    {
        $this->checkouts = new ArrayCollection();
        $this->invoicingMethods = new ArrayCollection();
        $this->Paymentplace = new ArrayCollection();
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
            $invoicingMethod->setCountry($this);
        }

        return $this;
    }

    public function removeInvoicingMethod(InvoicingMethod $invoicingMethod): self
    {
        if ($this->invoicingMethods->removeElement($invoicingMethod)) {
            // set the owning side to null (unless already changed)
            if ($invoicingMethod->getCountry() === $this) {
                $invoicingMethod->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rate>
     */
    public function getPaymentplace(): Collection
    {
        return $this->Paymentplace;
    }

    public function addPaymentplace(Rate $paymentplace): self
    {
        if (!$this->Paymentplace->contains($paymentplace)) {
            $this->Paymentplace[] = $paymentplace;
            $paymentplace->setCountry($this);
        }

        return $this;
    }

    public function removePaymentplace(Rate $paymentplace): self
    {
        if ($this->Paymentplace->removeElement($paymentplace)) {
            // set the owning side to null (unless already changed)
            if ($paymentplace->getCountry() === $this) {
                $paymentplace->setCountry(null);
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
            $constraint->addCountry($this);
        }

        return $this;
    }

    public function removeConstraint(Constraints $constraint): self
    {
        if ($this->constraints->removeElement($constraint)) {
            $constraint->removeCountry($this);
        }

        return $this;
    }
}
