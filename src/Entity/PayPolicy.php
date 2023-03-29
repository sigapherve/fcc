<?php

namespace App\Entity;

use App\Repository\PayPolicyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PayPolicyRepository::class)
 */
class PayPolicy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PaymentPlace::class, inversedBy="payPolicies")
     */
    private $PaymentPlace;

    /**
     * @ORM\ManyToMany(targetEntity=Charge::class, inversedBy="payPolicies")
     */
    private $Charge;

    /**
     * @ORM\ManyToOne(targetEntity=PrepaidCollect::class, inversedBy="payPolicies")
     */
    private $policy;

    public function __construct()
    {
        $this->Charge = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentPlace(): ?PaymentPlace
    {
        return $this->PaymentPlace;
    }

    public function setPaymentPlace(?PaymentPlace $PaymentPlace): self
    {
        $this->PaymentPlace = $PaymentPlace;

        return $this;
    }

    /**
     * @return Collection<int, Charge>
     */
    public function getCharge(): Collection
    {
        return $this->Charge;
    }

    public function addCharge(Charge $charge): self
    {
        if (!$this->Charge->contains($charge)) {
            $this->Charge[] = $charge;
        }

        return $this;
    }

    public function removeCharge(Charge $charge): self
    {
        $this->Charge->removeElement($charge);

        return $this;
    }

    public function getPolicy(): ?PrepaidCollect
    {
        return $this->policy;
    }

    public function setPolicy(?PrepaidCollect $policy): self
    {
        $this->policy = $policy;

        return $this;
    }
}
