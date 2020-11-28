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
      $this->render('profil.seeProfil', ["posts" => $posts->getAllPosts()]);
    }

    public function addPostForm() {

      // Si un formulaire a été envoyé, on ajoute la publication
      if(isset($_POST["post"])) {
        $post = new Post;
        $post->addPost($_POST["post"]);
      }

      // On affiche le profil
      $this->render('profil.seeProfil');

    }

}
