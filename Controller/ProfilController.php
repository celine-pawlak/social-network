<?php

namespace App\Controller;

use App\Database\Post;
use App\Database\User;

class ProfilController extends AppController
{
    public $errors = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function profil(){
      $posts = new Post;
      $infosUser = new User;
      // méthode d'affichage des vues, reçoit en entrée le nom de la vue et les données
      $this->render('profil.seeProfil', [
        "posts" => $posts->getAllPosts(),
        "hobbies" => $infosUser->getHobbies(),
        "reacts" => $posts->getReacts(),
        "technologies" => $infosUser->getTechnologies(),
        "infosUser" => $infosUser->getInfosUser(),
        "presentation" => $infosUser->getPresentation()
        ]);
    }

    public function setProfil(){
        $id_user = $_SESSION['user']['id'];
        $user = new User;
        $infos_user = $user->showProfil($id_user);

        $this->render('profil.setProfil', compact('infos_user'));
    }

    public function addPostForm() {
      $infosUser = new User;
      // Si un formulaire a été envoyé, on ajoute la publication
      if(isset($_POST["post"])) {
        $post = new Post;
        $post->addPost($_POST["post"]);
      }

      $posts = new Post;
      // On affiche le profil
      $this->render('profil.seeProfil', [
        "posts" => $posts->getAllPosts(),
        "hobbies" => $infosUser->getHobbies(),
        "reacts" => $posts->getReacts(),
        "technologies" => $infosUser->getTechnologies(),
        "infosUser" => $infosUser->getInfosUser(),
        "presentation" => $infosUser->getPresentation()
      ]);
    }

    public function addHobbies(){

      $hobbies = new User;
      $hobbies->addHobbies([$_POST["hobby1"], $_POST["hobby2"],$_POST["hobby3"]]);

    }

    public function addTechnologies(){

      $technologies = new User;
      $technologies->addTechnologies([$_POST["tech1"], $_POST["tech2"],$_POST["tech3"]]);
    }

    public function updatePresentation(){
      echo "presentation";
      $presentation = new User;
      $presentation->updatePresentation($_POST['presentation']);
    }
}
