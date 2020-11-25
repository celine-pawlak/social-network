<?php

namespace App\Controller;


class IndexController extends AppController
{

    public $errors = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        echo 'coucou';
        // Si connecte
        //  Action fil d'actualite

        // Si non connecte
        // Action connexion

    }

    public function fildactualite(){

    }

}