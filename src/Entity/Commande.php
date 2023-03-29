<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 * @ORM\Table(name="Commande")
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=customer::class, inversedBy="commandes")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=country::class, inversedBy="commandes")
     */
    private $deliverycountry;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=Cotation::class, mappedBy="commande")
     */
    private $cotations;

    public function __construct()
    {
        $this->cotations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?customer
    {
        return $this->client;
    }

    public function setClient(?customer $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getDeliverycountry(): ?country
    {
        return $this->deliverycountry;
    }

    public function setDeliverycountry(?country $deliverycountry): self
    {
        $this->deliverycountry = $deliverycountry;

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

    /**
     * @return Collection<int, Cotation>
     */
    public function getCotations(): Collection
    {
        return $this->cotations;
    }

    public function addCotation(Cotation $cotation): self
    {
        if (!$this->cotations->contains($cotation)) {
            $this->cotations[] = $cotation;
            $cotation->setCommande($this);
        }

        return $this;
    }

    public function removeCotation(Cotation $cotation): self
    {
        if ($this->cotations->removeElement($cotation)) {
            // set the owning side to null (unless already changed)
            if ($cotation->getCommande() === $this) {
                $cotation->setCommande(null);
            }
        }

        return $this;
    }
}
