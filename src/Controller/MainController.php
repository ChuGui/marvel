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
     * @Route("/show/{page}/{numberOfCharacters}/{offset}", name="show", requirements={"page"="\d+", "numberOfCharacters"="\d+", "offset"="\d+"})
     * @param $page
     * @param int $numberOfCharacters
     * @param int $offset
     * @param MarvelApi $marvelApi
     * @param Paginator $paginator
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showCharacters($page = null,$numberOfCharacters = 20, $offset = 100, MarvelApi $marvelApi, Paginator $paginator){

        //Si la page est null on affiche tous les personnage sur une seule page
        if(!$page){
            $characters = $marvelApi->getCharacters($numberOfCharacters, $offset);
        }else{
            //Sinon on fait une pagination
            $characters = $paginator->showElts(8, $page, $marvelApi->getCharacters($numberOfCharacters, $offset));
        }

        $totalPages = count($marvelApi->getCharacters($numberOfCharacters, $offset))/8;

        return $this->render('main/show.html.twig', [
            'characters' => $characters,
            'totalPages' => $totalPages,
            'page' => $page
        ]);
    }

    /**
     * @Route("/{id}", name="show_details", requirements={"id" = "\d+"})
     * @param $id
     * @param MarvelApi $marvelApi
     * @return
     * @throws \Exception
     */
    public function showDetails($id, MarvelApi $marvelApi){

        $character = $marvelApi->getOneCaracterById($id);
        if($character->code == 404){
            $this->addFlash('danger', "L'id fournit ne correspond à aucun personnage");
            throw new \Exception("L'id fournit ne correspond à aucun personnage");
        };

        return $this->render('main/details.html.twig', [
            'character' => $character->body->data->results[0]
        ]);
    }


}
