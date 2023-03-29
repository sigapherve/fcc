<?php

namespace App\Entity;

use App\Repository\CheckoutRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CheckoutRepository::class)
 */
class Checkout
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="checkouts")
     */
    private $customer;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $checkoutdate;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="checkouts")
     */
    private $shipto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCheckoutdate(): ?\DateTimeInterface
    {
        return $this->checkoutdate;
    }

    public function setCheckoutdate(?\DateTimeInterface $checkoutdate): self
    {
        $this->checkoutdate = $checkoutdate;

        return $this;
    }

    public function getShipto(): ?Country
    {
        return $this->shipto;
    }

    public function setShipto(?Country $shipto): self
    {
        $this->shipto = $shipto;

        return $this;
    }
}
