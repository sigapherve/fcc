<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReponseRepository::class)
 */
class Reponse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Cotation::class, inversedBy="reponses")
     */
    private $Cotation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $message;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Amount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AmountCurrency;

    /**
     * @ORM\ManyToOne(targetEntity=PaymentPlace::class, inversedBy="reponses")
     */
    private $paymentplace;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCotation(): ?Cotation
    {
        return $this->Cotation;
    }

    public function setCotation(?Cotation $Cotation): self
    {
        $this->Cotation = $Cotation;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->Amount;
    }

    public function setAmount(?float $Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function getAmountCurrency(): ?string
    {
        return $this->AmountCurrency;
    }

    public function setAmountCurrency(?string $AmountCurrency): self
    {
        $this->AmountCurrency = $AmountCurrency;

        return $this;
    }

    public function getPaymentplace(): ?PaymentPlace
    {
        return $this->paymentplace;
    }

    public function setPaymentplace(?PaymentPlace $paymentplace): self
    {
        $this->paymentplace = $paymentplace;

        return $this;
    }
}
