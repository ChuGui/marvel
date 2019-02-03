<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MarvelApi;
use App\Service\Paginator;

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
     * @Route("/show/{page}", name="show", requirements={"page"="\d+"})
     * @param $page
     * @param MarvelApi $marvelApi
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showApiAnswer($page = null, MarvelApi $marvelApi, Paginator $paginator){
        if($page === null){
            $characters = $marvelApi->getCharacters();
        }else{
            $characters = $paginator->showElts(8, $page, $marvelApi->getCharacters());
        }
        
        $totalCharacters = count($characters)/8;

        return $this->render('main/show.html.twig', [
            'characters' => $characters,
            'totalCharacters' => $totalCharacters
        ]);
    }


}
