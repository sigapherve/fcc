<?php

namespace App\Entity;

use App\Repository\ChargeRepository;
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
     * @ORM\ManyToOne(targetEntity=PaymentPlace::class, inversedBy="charges")
     */
    private $Paymentplace;

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

    public function getPaymentplace(): ?PaymentPlace
    {
        return $this->Paymentplace;
    }

    public function setPaymentplace(?PaymentPlace $Paymentplace): self
    {
        $this->Paymentplace = $Paymentplace;

        return $this;
    }
}
