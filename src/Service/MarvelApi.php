<?php

namespace App\Service;

use Unirest;

class MarvelApi {

    private $publicKey;

    private $secretKey;

    public function __construct($marvelSecretApikey, $marvelPublicApikey)
    {
        $this->publicKey = $marvelPublicApikey;
        $this->secretKey = $marvelSecretApikey;
    }

    public function getCharacter($name = null) {
//        Search a caracter from name

//        $headers = ['Accept' => 'application/json'];
//        $query = ['' => ''];
//
//        $caracter = Unirest\Request::get('http://gateway.marvel.com/v1/public/comics?ts=1&apikey=1234&hash=ffd275c5130566a2916217b101f26150');
        return $this->secretKey;
    }


}