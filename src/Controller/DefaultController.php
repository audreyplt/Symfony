<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class DefaultController
{

    /**
     * @param Environment $twig
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(Environment $twig)
    {
        $content = $twig->render('index.html.twig');
        return new Response($content);
    }

    /**
     * @param Environment $twig
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function contact(Environment $twig)
    {
        $content = $twig->render('contact/contact.html.twig');
        return new Response($content);
    }
}


