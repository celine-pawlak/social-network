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
      $posts = new Post;
      // méthode d'affichage des vues, reçoit en entrée le nom de la vue et les données
      $this->render('profil.seeProfil', ["posts" => $posts->getAllPosts()]);
    }

    public function addPostForm() {
      echo "test";
      // Si un formulaire a été envoyé, on ajoute la publication
      if(isset($_POST["post"])) {
        $post = new Post;
        $post->addPost($_POST["post"]);
      }

      $posts = new Post;
      // On affiche le profil
      $this->render('profil.seeProfil', ["posts" => $posts->getAllPosts()]);

    }

}
