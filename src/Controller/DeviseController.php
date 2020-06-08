<?php


namespace App\Controller;


use App\Service\DeviseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DeviseController extends AbstractController
{

    /**
     * @param DeviseService $deviseServ
     * @param Request $request
     * @param $to
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function change(DeviseService $deviseServ, Request $request, $to)
    {
        $deviseServ->setUsagerDevise($to);

        $request->getSession()
            ->getFlashBag();
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }

    /**
     * @param DeviseService $deviseServ
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deviseCourante(DeviseService $deviseServ)
    {
        //Permet d'afficher la devise séléctionnée
        return $this->render('commun/devise.html.twig', [
            'deviseChoix' => $deviseServ->toStringDevise()
        ]
        );
    }
}