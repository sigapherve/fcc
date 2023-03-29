<?php

namespace App\Entity;

use App\Repository\PaymentPlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaymentPlaceRepository::class)
 */
class PaymentPlace
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
    private $description;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $currency;

    /**
     * @ORM\OneToMany(targetEntity=Charge::class, mappedBy="Paymentplace")
     */
    private $charges;

    /**
     * @ORM\OneToMany(targetEntity=Rate::class, mappedBy="Paymentplace")
     */
    private $rates;

    /**
     * @ORM\OneToMany(targetEntity=Charge::class, mappedBy="PaymentPlace")
     */
    private $viewcharges;

    /**
     * @ORM\OneToMany(targetEntity=PayPolicy::class, mappedBy="PaymentPlace")
     */
    private $payPolicies;


    public function __construct()
    {
        $this->charges = new ArrayCollection();
        $this->rates = new ArrayCollection();
       // $this->paymentPolicies = new ArrayCollection();
       $this->viewcharges = new ArrayCollection();
       $this->payPolicies = new ArrayCollection();
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

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return Collection<int, Charge>
     */
    public function getCharges(): Collection
    {
        return $this->charges;
    }

    public function addCharge(Charge $charge): self
    {
        if (!$this->charges->contains($charge)) {
            $this->charges[] = $charge;
            $charge->setPaymentplace($this);
        }

        return $this;
    }

    public function removeCharge(Charge $charge): self
    {
        if ($this->charges->removeElement($charge)) {
            // set the owning side to null (unless already changed)
            if ($charge->getPaymentplace() === $this) {
                $charge->setPaymentplace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rate>
     */
    public function getRates(): Collection
    {
        return $this->rates;
    }

    public function addRate(Rate $rate): self
    {
        if (!$this->rates->contains($rate)) {
            $this->rates[] = $rate;
            $rate->setPaymentplace($this);
        }

        return $this;
    }

    public function removeRate(Rate $rate): self
    {
        if ($this->rates->removeElement($rate)) {
            // set the owning side to null (unless already changed)
            if ($rate->getPaymentplace() === $this) {
                $rate->setPaymentplace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Charge>
     */
    public function getViewcharges(): Collection
    {
        return $this->viewcharges;
    }

    public function addViewcharge(Charge $viewcharge): self
    {
        if (!$this->viewcharges->contains($viewcharge)) {
            $this->viewcharges[] = $viewcharge;
            $viewcharge->setPaymentPlace($this);
        }

        return $this;
    }

    public function removeViewcharge(Charge $viewcharge): self
    {
        if ($this->viewcharges->removeElement($viewcharge)) {
            // set the owning side to null (unless already changed)
            if ($viewcharge->getPaymentPlace() === $this) {
                $viewcharge->setPaymentPlace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PayPolicy>
     */
    public function getPayPolicies(): Collection
    {
        return $this->payPolicies;
    }

    public function addPayPolicy(PayPolicy $payPolicy): self
    {
        if (!$this->payPolicies->contains($payPolicy)) {
            $this->payPolicies[] = $payPolicy;
            $payPolicy->setPaymentPlace($this);
        }

        return $this;
    }

    public function removePayPolicy(PayPolicy $payPolicy): self
    {
        if ($this->payPolicies->removeElement($payPolicy)) {
            // set the owning side to null (unless already changed)
            if ($payPolicy->getPaymentPlace() === $this) {
                $payPolicy->setPaymentPlace(null);
            }
        }

        return $this;
    }

    
}
