<?php

namespace App\Controller;

use App\Database\Reaction;


class IndexController extends AppController
{

    public $errors = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // Si connecte
        // Action fil d'actualite
        // $this->render('index.wall');

        // Si non connecte
        // Action connexion
        $this->render('index.connexion');
    }

    public function inscription(){
        $this->render('index.inscription');
    }

    public function insertUser(){
        if(isset($_POST['email']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['birthday']) && isset($_POST['password']) && $_POST['cofirmation_password']) {
            $email = $_POST['email'];
            $prenom = $_POST['first_name'];
            $nom = $_POST['last_name'];
            $birthday = $_POST['birthday'];
            $password = $_POST['password']
            $conf_pw = $_POST['confirmation_password'];
        }

        return 'Success';
    }

    public function fildactualite(){

    }
    public function getEmoji()
        {
            if(isset($_POST['action']) && $_POST['action']=='getmoji')
                {
                    $reaction = new Reaction;
                    echo $reaction->getEmoji();
                }
        }
    public function insertEmoji()
        {            
            $id_user = 3; //A modifier par l'id de l'utilisateur
            if(isset($_POST['action']) && $_POST['action']=='insertEmoji')
                {
                    $id_react = $_POST['id_react'];
                    $id_bloc = $_POST['id_bloc'];
                    $bloc = $_POST['bloc'];
                    $reaction = new Reaction;
                    $reaction->insertEmoji($id_user, $id_react, $id_bloc, $bloc);
                }
        }
}


