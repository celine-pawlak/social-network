<?php

namespace App\Controller;
use App\Database\Post;

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
}
