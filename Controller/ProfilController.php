<?php

namespace App\Controller;

use App\Database\Post;
use App\Database\User;
use App\Database\Comment;

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
      $this->render('profil.seeMonProfil', [
        "id_user" => $_SESSION['user']['id'],
        "posts" => $posts->getAllPosts($_SESSION['user']['id']),
        "hobbies" => $infosUser->getHobbies($_SESSION['user']['id']),
        "reacts" => $posts->getReacts($_SESSION['user']['id']),
        "technologies" => $infosUser->getTechnologies($_SESSION['user']['id']),
        "infosUser" => $infosUser->getInfosUser($_SESSION['user']['id']),
        "presentation" => $infosUser->getPresentation($_SESSION['user']['id'])
        ]);
    }

    public function profil($id){ // Profil des autres utilisateurs

      $posts = new Post;
      $infosUser = new User;
      $commentaires = new Comment;

      // méthode d'affichage des vues, reçoit en entrée le nom de la vue et les données
      $this->render('profil.seeProfil', [
        "id_user" => $id,
        "posts" => $posts->getAllPosts($id),
        "hobbies" => $infosUser->getHobbies($id),
        "reacts" => $posts->getReacts($id),
        "technologies" => $infosUser->getTechnologies($id),
        "infosUser" => $infosUser->getInfosUser($id),
        "presentation" => $infosUser->getPresentation($id),
        "commentaires" => $commentaires->getAllComment($id)
        ]);
    }

    public function ajouterCommentaire() {
      $comment = new Comment;
      $comment->addComment($_POST["content"], $_POST["id_post"], $_POST["id_user"]);
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

      $technologies = new User;
      $technologies->addTechnologies([$_POST["tech1"], $_POST["tech2"],$_POST["tech3"]], $_SESSION['user']['id']);

    }

    public function updatePresentation(){
      $presentation = new User;
      $presentation->updatePresentation($_POST['presentation'], $_SESSION['user']['id']);
    }
}
