<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usager", inversedBy="commandes")
     */
    private $usager;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_commande;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut = 'en attente';

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneCommande", mappedBy="commandes")
     */
    private $ligne_commande;

    public function __construct()
    {
        $this->ligne_commande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsager(): ?usager
    {
        return $this->usager;
    }

    public function setUsager(?usager $usager): self
    {
        $this->usager = $usager;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(\DateTimeInterface $date_commande): self
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @param ArrayCollection $ligne_commande
     */
    public function setLigneCommande(ArrayCollection $ligne_commande): void
    {
        $this->ligne_commande = $ligne_commande;
    }

    /**
     * @return ArrayCollection
     */
    public function getLigneCommande(): ArrayCollection
    {
        return $this->ligne_commande;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): self
    {
        if (!$this->ligne_commande->contains($ligneCommande)) {
            $this->ligne_commande[] = $ligneCommande;
            $ligneCommande->setIdCommande($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): self
    {
        if ($this->ligne_commande->contains($ligneCommande)) {
            $this->ligne_commande->removeElement($ligneCommande);
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getCommande() === $this) {
                $ligneCommande->setIdCommande(null);
            }
        }

        return $this;
    }


}
