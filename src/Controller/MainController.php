<?php

namespace App\Controller;

use App\Form\CharactersType;
use App\Form\CharacterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MarvelApi;
use App\Service\Paginator;

class MainController extends AbstractController
{
    /**
     * Affiche la page d'accueil du site
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return $this->render('main/homepage.html.twig', [
        ]);
    }

    /**
     * Affiche tous les personnage voulus, Soit avec une pagination soit sans.
     * @Route("/show/{page}/{charactersQty}/{offset}", name="show_characters", requirements={"page"="\d+", "charactersQty"="\d+", "offset"="\d+"})
     * @param null $page
     * @param int $charactersQty
     * @param int $offset
     * @param MarvelApi $marvelApi Service créé pour géré l'api de marvel
     * @param Paginator $paginator Service crée pour créé une pagination
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showCharacters( $page = null, $charactersQty = 20, $offset = 100, MarvelApi $marvelApi, Paginator $paginator, Request $request)
    {
        //Si les personnages ne sont pas fournit on télécharge 20 personnages à partir du 100ème par défaut
        $characters = $marvelApi->getCharacters($charactersQty, $offset);


        //On affiche 8 éléments par pages, on pourrait proposer à l'utilisateur le nombre d'élément à afficher par page
        $totalPages = count($characters) / 8;

        // Si le numéro de page est fourni, on utilise le paginator, sinon tout les personnages seront affichés sur une seule page
        if ($page) {
            $characters = $paginator->showElts(8, $page, $characters);
        }

        // Création et gestion  du formulaire pour la recherche par nombre de personnages
        $charactersForm = $this->createForm(CharactersType::class);
        $charactersForm->handleRequest($request);

        if ($charactersForm->isSubmitted() && $charactersForm->isValid()) {
            $data = $charactersForm->getData();
            $charactersQty = $data['charactersQty'];
            $offset = $data['offset'];
            return $this->redirectToRoute('show_characters', [
                'charactersQty' => $charactersQty,
                'offset' => $offset,
                'page' => 1,
            ]);
        }


        //Création et gestion du formulaire pour la recherche par nom du personnage
        $characterForm = $this->createForm(CharacterType::class);
        $characterForm->handleRequest($request);
        if($characterForm->isSubmitted() && $characterForm->isValid()){
            $data = $characterForm->getData();
            $name = $data['name'];
            $id = $marvelApi->getCharacterByName($name);
            if(!$id){
                $this->addFlash('danger', "Désolé mais nous n'avons pas trouvé de personnage pour le nom '$name'");
                return $this->redirectToRoute('show_characters');
            }
            return $this->redirectToRoute('show_details', [
               'id' => $id
            ]);
        }

        return $this->render('main/showCharacters.html.twig', [
            'characters' => $characters,
            'charactersQty' => $charactersQty,
            'offset' => $offset,
            'totalPages' => $totalPages,
            'page' => $page,
            'charactersForm' => $charactersForm->createView(),
            'characterForm' => $characterForm->createView(),
            'totalCharacters' => $marvelApi->totalCharacters()
        ]);
    }

    /**
     * @Route("/{id}", name="show_details", requirements={"id" = "\d+"})
     * @param $id
     * @param MarvelApi $marvelApi
     * @return
     * @throws \Exception
     */
    public function showDetails($id, MarvelApi $marvelApi)
    {
        dump($id);
        $character = $marvelApi->getOneCaracterById($id);
        if ($character->code == 404) {
            $this->addFlash('danger', "L'id fournit ne correspond à aucun personnage");
            throw new \HttpException("L'id fournit ne correspond à aucun personnage", '500');
        };

        return $this->render('main/details.html.twig', [
            'character' => $character
        ]);
    }


}
