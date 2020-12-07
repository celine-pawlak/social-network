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

    public function index(){        
        // Si connecte   
        // Action fil d'actualite
        $this->render('index.wall');        
      
        // Si non connecte
        // Action connexion
        // $this->render('index.connexion');
    }

    public function fildactualite(){    
        echo 'tototupu';
        // $reaction = new Reaction;
        // return $reaction->getEmoji();
        // if(isset($_POST['action']) && $_POST['action']=='getmoji')
        //     {
        //         echo 'tot';
                // $reaction = new Reaction;
                // var_dump($reaction->getEmoji());
            // }
    }

}


