<?php

namespace App\Entity;

use App\Repository\ChargeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChargeRepository::class)
 */
class Charge
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
     * @ORM\ManyToMany(targetEntity=PayPolicy::class, mappedBy="Charge")
     */
    private $payPolicies;

    public function __construct()
    {
        $this->payPolicies = new ArrayCollection();
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
            $payPolicy->addCharge($this);
        }

        return $this;
    }

    public function removePayPolicy(PayPolicy $payPolicy): self
    {
        if ($this->payPolicies->removeElement($payPolicy)) {
            $payPolicy->removeCharge($this);
        }

        return $this;
    }
}
