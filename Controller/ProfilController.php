<?php

namespace App\Controller;
use App\Database\User;

class ProfilController extends AppController
{
    public $errors = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function profil(){
        $this->render('profil.seeProfil');
    }

    public function setProfil(){
        $this->render('profil.setProfil');
    }
}