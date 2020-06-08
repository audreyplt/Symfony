<?php

namespace SoapClient;

use App\Entity\Categorie;
use App\Entity\LigneCommande;

class Produit
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $libelle;

    /**
     * @var Categorie
     */
    private $categorie;

    /**
     * @var string
     */
    private $texte;

    /**
     * @var string
     */
    private $visuel;

    /**
     * @var float
     */
    private $prix;

    /**
     * @var LigneCommande
     */
    private $ligneCommandes;

    public function __construct(int $id, string $libelle, Categorie $categorie, string $texte, string $visuel, float $prix, LigneCommande $ligneCommandes)
    {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->categorie = $categorie;
        $this->texte = $texte;
        $this->visuel = $visuel;
        $this->prix = $prix;
        $this->ligneCommandes = $ligneCommandes;
    }

}