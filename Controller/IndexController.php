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
        // Si connecte
        // Action fil d'actualite
        // $this->render('index.news');

        // Si non connecte
        // Action connexion
        $this->render('index.connexion');
    }

    public function inscription(){
        $this->render('index.inscription');
    }

    public function fildactualite(){

    }

}