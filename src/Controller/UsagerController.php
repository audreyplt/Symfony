<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\LigneCommande;
use App\Entity\Usager;
use App\Form\UsagerType;
use App\Repository\UsagerRepository;
use App\Service\DeviseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/usager")
 */
class UsagerController extends AbstractController
{

    const ID_USAGER_SESSION = 'idusager'; // Le nom de la variable d'usager de session

    /**
     * @param UsagerRepository $usagerRepository
     * @return Response
     */
    public function index(UsagerRepository $usagerRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $idUsager = $this->getUser()->getId();

        $commandes = $em->getRepository(Commande::class)->findByUsager($idUsager);

        return $this->render('usager/index.html.twig', [
            'usager' => $usagerRepository->findOneBy(array(
                'id' => $idUsager)),
            'commandes' => $commandes
        ]);
    }

    /**
     * @param Request $request
     * @param SessionInterface $session
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function nouvelleUsager(Request $request, SessionInterface $session, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $usager = new Usager();

        $form = $this->createForm(UsagerType::class, $usager);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encryptage du mot de passe
            $usager->setPassword($passwordEncoder->encodePassword($usager, $usager->getPassword()));
            // Définition du rôle
            $usager->setRoles(["ROLE_CLIENT"]);
            // persistance
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usager);
            $entityManager->flush();
            $session->set(self::ID_USAGER_SESSION, $usager->getId());
            return $this->redirectToRoute('usager_accueil');
        }

        return $this->render('usager/new.html.twig',
            [
                'usager' => $usager,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @param DeviseService $deviseServ
     * @return Response
     */
    public function commandes(DeviseService $deviseServ)
    {
        $em = $this->getDoctrine()->getManager();

        //Récupération des commandes
        $commandes = $em->getRepository(Commande::class)->findByUsager($this->getUser()->getId());

        $prixcommandes = [];
        $quantitecommandes = [];

        //Récupération du prix et des quantités de chaque commande
        foreach ($commandes as $commande) {
            $lignecommandes = $em->getRepository(LigneCommande::class)->findByCommandes($commande->getId());
            $prixcommandes[$commande->getId()] = 0;
            $quantitecommandes[$commande->getId()] = 0;
            foreach ($lignecommandes as $lignecommande)
                $prixcommandes[$commande->getId()] += $lignecommande->getQuantite() * $lignecommande->getPrix();
            $quantitecommandes[$commande->getId()] += $lignecommande->getQuantite();
        }

        return $this->render(
            'usager/commandes.html.twig',
            [
                'commandes' => $commandes,
                'prixcommandes' => $prixcommandes,
                'quantitecommandes' => $quantitecommandes,
                'devise' => $deviseServ->toStringDevise()
            ]
        );
    }
}
