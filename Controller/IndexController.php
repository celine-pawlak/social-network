<?php

namespace App\Controller;

use App\Database\Reaction;
use App\Database\User;

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
        if(isset($_POST['mail']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['birthday']) && isset($_POST['password']) && isset($_POST['confirmation_password'])) {

            $mail = $_POST['mail'];
            $prenom = $_POST['first_name'];
            $nom = $_POST['last_name'];
            $birthday = $_POST['birthday'];
            $password = $_POST['password'];
            $conf_pw = $_POST['confirmation_password'];

            $user = new User;

            if ($user->isExist($mail) == true) {
                if($user->isSamepassword($password, $conf_pw) == true) {
                    $user->inscription($mail, $prenom, $nom, $birthday, $password);
                    echo 'Success';
                } else {
                    array_push($this->errors, 'Les mots de passe ne sont pas identiques');
                }
            } else {
                array_push($this->errors, 'Login déjà existant');
            }

        } else {
            array_push($this->errors, 'Informations incomplètes');
        }
        $erreurs_str = implode(",", $this->errors);
        echo $erreurs_str;
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


