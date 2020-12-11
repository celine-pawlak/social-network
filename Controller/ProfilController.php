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
        "infosUser" => $infosUser->getInfosUser()
      ]);
    }

    public function addPostForm() {
      // Si un formulaire a été envoyé, on ajoute la publication
      if(isset($_POST["post"])) {
        $post = new Post;
        $post->addPost($_POST["post"]);
      }

      $posts = new Post;
      // On affiche le profil
      $this->render('profil.seeProfil', [
        "posts" => $posts->getAllPosts(),
        "hobbies" => [
          "hobby1" => "blabla",
          "hobby2" => "ploufplouf",
          "hobby3" => "toctoc"
        ]
      ]);

    }

    public function addHobbies(){

      $hobbies = new User;
      $posts = new Post;

      $hobbies->addHobbies([$_POST["hobby1"], $_POST["hobby2"],$_POST["hobby3"]]);

    }

    public function addTechnologies($technologies){
      foreach($technologies as $technology) {
        // s'il n'existe dans la table technologies, on le créé
        $query = $this->_db->prepare("SELECT COUNT(*) FROM technologies WHERE name = ?");
        $query->execute([$technology]);

        if($query->fetchColumn() == 0) {
          $query = $this->_db->prepare("INSERT INTO technologies(name) VALUES (?)");
          $query->execute([$technology]);
        }

      }
    }
}
