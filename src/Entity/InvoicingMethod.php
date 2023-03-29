<?php

namespace App\Entity;

use App\Repository\InvoicingMethodRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvoicingMethodRepository::class)
 */
class InvoicingMethod
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="invoicingMethods")
     */
    private $Country;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="invoicingMethods")
     */
    private $Product;

    /**
     * @ORM\ManyToOne(targetEntity=Method::class, inversedBy="invoicingMethods")
     */
    private $methodused;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?Country
    {
        return $this->Country;
    }

    public function setCountry(?Country $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->Product;
    }

    public function setProduct(?Product $Product): self
    {
        $this->Product = $Product;

        return $this;
    }

    public function getMethodused(): ?Method
    {
        return $this->methodused;
    }

    public function setMethodused(?Method $methodused): self
    {
        $this->methodused = $methodused;

        return $this;
    }
}
