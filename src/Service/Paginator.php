<?php

namespace App\Service;

class Paginator {


    //Le paginator renvoie un nombre d'éléments en fonction du numéro de page appelé et du nombre d'élément voulu
    /**
     * @param $length
     * @param $page
     * @param $array
     * @return array
     */
    public function showElts($length, $page, $array){

        $numberOfElts = $length;
        $offset = ($page - 1) * 8;
        $elts = array_slice($array, $offset, $numberOfElts);

        return $elts;
    }

}