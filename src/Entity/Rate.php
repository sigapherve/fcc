<?php

namespace App\Entity;

use App\Repository\RateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RateRepository::class)
 */
class Rate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="Paymentplace")
     */
    private $Country;

    /**
     * @ORM\ManyToOne(targetEntity=PaymentPlace::class, inversedBy="rates")
     */
    private $Paymentplace;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Amount;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=UnitFact::class, inversedBy="rates")
     */
    private $UnitFact;

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

    public function getPaymentplace(): ?PaymentPlace
    {
        return $this->Paymentplace;
    }

    public function setPaymentplace(?PaymentPlace $Paymentplace): self
    {
        $this->Paymentplace = $Paymentplace;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUnitFact(): ?UnitFact
    {
        return $this->UnitFact;
    }

    public function setUnitFact(?UnitFact $UnitFact): self
    {
        $this->UnitFact = $UnitFact;

        return $this;
    }
}
