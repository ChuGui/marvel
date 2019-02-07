<?php

namespace App\Service;

use Unirest;

class MarvelApi {

    private $publicKey;

    private $secretKey;

    private $timestamp;

    private $hash;

    private $apiKey;

    public function __construct($marvelSecretApikey, $marvelPublicApikey)
    {
        $this->publicKey = $marvelPublicApikey;
        $this->secretKey = $marvelSecretApikey;
        $this->timestamp = time();
        $this->hash = md5($this->timestamp . $this->secretKey . $this->publicKey);
        $this->apiKey = 'ts=' . $this->timestamp .'&apikey='. $this->publicKey .'&hash='. $this->hash;

    }

    /**
     * Permet de savoir le nombre de personnages disponible depuis l'api marvel
     * @return mixed
     */
    public function totalCharacters(){
        $characters = Unirest\Request::get("http://gateway.marvel.com/v1/public/characters?" . $this->apiKey);
        $totalCharacters = $characters->body->data->total;
        return  $totalCharacters;
    }

    /**
     * Get the $charactersQty first characters from the offset th character
     * @param int $charactersQty
     * @param int $offset
     * @return Unirest\Response.
     */
    public function getCharacters(int $charactersQty, int $offset) {

        $characters = Unirest\Request::get("http://gateway.marvel.com/v1/public/characters?limit=$charactersQty&offset=$offset&" . $this->apiKey);
        $characters = $characters->body->data->results;
        return  $characters;
    }

    /**
     * Permet de récupérer l'id d'un personnage grâce à son nom
     * @param $name
     * @return mixed
     */
    public function getCharacterByName($name){
        $character = Unirest\Request::get("http://gateway.marvel.com/v1/public/characters?name=$name&" . $this->apiKey);
        if(empty($character->body->data->results)){
            return null;
        };

        return $character->body->data->results[0]->id;
    }

    /**
     * Permet de récupérer un personnage grâce à son id
     * @param $id
     * @return mixed
     */
    public function getOneCaracterById($id) {
        $character = Unirest\Request::get("http://gateway.marvel.com/v1/public/characters/$id?" . $this->apiKey);
        return $character;
    }


}