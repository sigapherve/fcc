<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 */
class Country
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $shortname;

    /**
     * @ORM\ManyToMany(targetEntity=Rate::class, mappedBy="country")
     */
    private $rates;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="deliverycountry")
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="deliverycountry")
     */
    private $commandes;

    /**
     * @ORM\ManyToMany(targetEntity=Contrainte::class, mappedBy="country")
     */
    private $contraintes;

    public function __construct()
    {
        $this->rates = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->contraintes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getShortname(): ?string
    {
        return $this->shortname;
    }

    public function setShortname(?string $shortname): self
    {
        $this->shortname = $shortname;

        return $this;
    }

    /**
     * @return Collection<int, Rate>
     */
    public function getRates(): Collection
    {
        return $this->rates;
    }

    public function addRate(Rate $rate): self
    {
        if (!$this->rates->contains($rate)) {
            $this->rates[] = $rate;
            $rate->addCountry($this);
        }

        return $this;
    }

    public function removeRate(Rate $rate): self
    {
        if ($this->rates->removeElement($rate)) {
            $rate->removeCountry($this);
        }

        return $this;
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

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setDeliverycountry($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getDeliverycountry() === $this) {
                $commande->setDeliverycountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contrainte>
     */
    public function getContraintes(): Collection
    {
        return $this->contraintes;
    }

    public function addContrainte(Contrainte $contrainte): self
    {
        if (!$this->contraintes->contains($contrainte)) {
            $this->contraintes[] = $contrainte;
            $contrainte->addCountry($this);
        }

        return $this;
    }

    public function removeContrainte(Contrainte $contrainte): self
    {
        if ($this->contraintes->removeElement($contrainte)) {
            $contrainte->removeCountry($this);
        }

        return $this;
    }
}
