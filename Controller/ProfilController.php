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

    public function monprofil(){
      $posts = new Post;
      $infosUser = new User;
      // méthode d'affichage des vues, reçoit en entrée le nom de la vue et les données
      $this->render('profil.seeProfil', [
        "posts" => $posts->getAllPosts($_SESSION['user']['id']),
        "hobbies" => $infosUser->getHobbies($_SESSION['user']['id']),
        "reacts" => $posts->getReacts($_SESSION['user']['id']),
        "technologies" => $infosUser->getTechnologies($_SESSION['user']['id']),
        "infosUser" => $infosUser->getInfosUser($_SESSION['user']['id']),
        "presentation" => $infosUser->getPresentation($_SESSION['user']['id'])
        ]);
    }

    public function profil(){ // Profil des autres utilisateurs
      $posts = new Post;
      $infosUser = new User;
      // méthode d'affichage des vues, reçoit en entrée le nom de la vue et les données
      $this->render('profil.seeProfil', [
        "posts" => $posts->getAllPosts(7),
        "hobbies" => $infosUser->getHobbies(7),
        "reacts" => $posts->getReacts(1),
        "technologies" => $infosUser->getTechnologies(7),
        "infosUser" => $infosUser->getInfosUser(7),
        "presentation" => $infosUser->getPresentation(7)
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
        $post->addPost($_POST["post"], $_SESSION['user']['id']);
      }

      $posts = new Post;
      // On affiche le profil
      $this->render('profil.seeProfil', [
        "posts" => $posts->getAllPosts($_SESSION['user']['id']),
        "hobbies" => $infosUser->getHobbies($_SESSION['user']['id']),
        "reacts" => $posts->getReacts($_SESSION['user']['id']),
        "technologies" => $infosUser->getTechnologies($_SESSION['user']['id']),
        "infosUser" => $infosUser->getInfosUser($_SESSION['user']['id']),
        "presentation" => $infosUser->getPresentation($_SESSION['user']['id'])
      ]);
    }

    public function addHobbies(){

      $hobbies = new User;
      $hobbies->addHobbies([$_POST["hobby1"], $_POST["hobby2"],$_POST["hobby3"]], $_SESSION['user']['id']);

    }

    public function addTechnologies(){

      var_dump($_POST);

      $technologies = new User;
      $technologies->addTechnologies([$_POST["tech1"], $_POST["tech2"],$_POST["tech3"]], $_SESSION['user']['id']);

    }

    public function updatePresentation(){
      $presentation = new User;
      $presentation->updatePresentation($_POST['presentation'], $_SESSION['user']['id']);
    }
}
