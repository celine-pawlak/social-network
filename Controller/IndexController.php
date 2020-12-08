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
            if(isset($_POST['action']) && $_POST['action']=='getmoji')
                {                
                    $reaction = new Reaction;
                    echo $reaction->getEmoji();
                }
        }
    public function insertEmoji()
        {
            if(isset($_POST['action']) && $_POST['action']=='insertEmoji')
                {                
                    $reaction = new Reaction;
                    echo $reaction->insertEmoji();
                }
        }

}


