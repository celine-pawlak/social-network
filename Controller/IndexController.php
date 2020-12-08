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
        $this->render('index.wall');        
      
        // Si non connecte
        // Action connexion
        // $this->render('index.connexion');
    }

    public function fildactualite(){    
        

    }
    public function getEmoji()
        {                  
            if(isset($_POST['action']) && $_POST['action']=='getEmoji')
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


