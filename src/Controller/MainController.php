<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MarvelApi;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return $this->render('main/homepage.html.twig', [
        ]);
    }

    /**
     * @Route("/show", name="show")
     * @param MarvelApi $characters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showApiAnswer(MarvelApi $marvelApi){

        $character = $marvelApi->getCharacter();
        dump($character);die;
        return $this->render('main/show.html.twig', [
        ]);
    }


}
