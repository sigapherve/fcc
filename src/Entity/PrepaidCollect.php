<?php

namespace App\Entity;

use App\Repository\PrepaidCollectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrepaidCollectRepository::class)
 */
class PrepaidCollect
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=7, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=PayPolicy::class, mappedBy="policy")
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
            $payPolicy->setPolicy($this);
        }

        return $this;
    }

    public function removePayPolicy(PayPolicy $payPolicy): self
    {
        if ($this->payPolicies->removeElement($payPolicy)) {
            // set the owning side to null (unless already changed)
            if ($payPolicy->getPolicy() === $this) {
                $payPolicy->setPolicy(null);
            }
        }

        return $this;
    }
}
