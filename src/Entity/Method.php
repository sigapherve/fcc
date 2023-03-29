<?php

namespace App\Entity;

use App\Repository\MethodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MethodRepository::class)
 */
class Method
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
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=InvoicingMethod::class, mappedBy="methodused")
     */
    private $invoicingMethods;

    public function __construct()
    {
        $this->invoicingMethods = new ArrayCollection();
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
            $invoicingMethod->setMethodused($this);
        }

        return $this;
    }

    public function removeInvoicingMethod(InvoicingMethod $invoicingMethod): self
    {
        if ($this->invoicingMethods->removeElement($invoicingMethod)) {
            // set the owning side to null (unless already changed)
            if ($invoicingMethod->getMethodused() === $this) {
                $invoicingMethod->setMethodused(null);
            }
        }

        return $this;
    }
}
