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

    //Get the $numberOfCharacters first characters from the offset th character
    public function getCharacters(int $numberOfCharacters, int $offset) {

        $caracters = Unirest\Request::get("http://gateway.marvel.com/v1/public/characters?limit=$numberOfCharacters&offset=$offset&" . $this->apiKey);
        $caracters = $caracters->body->data->results;
        return  $caracters;
    }


}