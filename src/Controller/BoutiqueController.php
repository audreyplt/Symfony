<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Service\BoutiqueService;
use App\Service\DeviseService;
use App\Service\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BoutiqueController extends AbstractController
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        //recherche des categories
        $categories = $em->getRepository(Categorie::class)->findAll();

        return $this->render('boutique/index.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @param $idRayon
     * @param DeviseService $deviseServ
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function rayon($idRayon,DeviseService $deviseServ)
    {
        $em = $this->getDoctrine()->getManager();

        //récupération des produits d'une catégorie
        $categorie = $em->getRepository(Categorie::class)->find($idRayon);
        $produits = $categorie->getProduits();



        return $this->render('boutique/rayon.html.twig', [
            'produits' => $produits,
            'categorie' => $categorie,
            'devise' => $deviseServ->toStringDevise()
        ]);
    }

    /**
     * @param $texte
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function chercher(Request $request, DeviseService $deviseServ)
    {
        $texte = $request->get('texte');
        //recherche des produits contenant la recherche
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findProduitsByLibelleOrTexte($texte);

        return $this->render('boutique/rayon.html.twig', [
            'produits' => $produits,
            'recherche' => $texte,
            'devise' => $deviseServ->toStringDevise()

        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function produitsLesPlusVendus()
    {
        //Récupération des produits les plus vendus
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findProduitsPlusVendus();

        return $this->render('boutique/articlesvendus.html.twig', [
            "produits" => $produits
        ]);
    }
}
