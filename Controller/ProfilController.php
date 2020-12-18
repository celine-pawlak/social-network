<?php

namespace App\Controller;

use App\Database\Post;
use App\Database\User;

class ProfilController extends AppController
{
    public $errors = [];


    public function test(){
      echo 'MARCHE';
    }

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

    public function updateProfil(){

      if(isset($_POST) && !empty($_POST)) {
        if (!isset($_FILES['avatar']) || empty($_FILES['avatar'])) {
          $img_avatar = "";
        } else {
          $img_avatar = $_FILES['avatar']['name'];
        }

        if (!isset($_POST['first_name']) || empty($_POST['first_name'])) {
          $first_name = "";
        } else {
          $first_name = $_POST['first_name'];
        }

        if (!isset($_POST['last_name']) || empty($_POST['last_name'])) {
          $last_name = "";
        } else {
          $last_name = $_POST['last_name'];
        }

        if (!isset($_POST['mail']) || empty($_POST['mail'])) {
          $mail = "";
        } else {
          $mail = $_POST['mail'];
        }

        if (!isset($_POST['current_password']) || empty($_POST['current_password'])) {
          $current_password = "";
        } else {
          $current_password = $_POST['current_password'];
        }

        if (!isset($_POST['new_password']) || empty($_POST['new_password'])) {
          $new_password = "";
        } else {
          $new_password = $_POST['new_password'];
        }

        if (!isset($_POST['conf_new_password']) || empty($_POST['conf_new_password'])) {
          $conf_new_password = "";
        } else {
          $conf_new_password = $_POST['conf_new_password'];
        }


        $update_user = new User;

        if($update_user->verifCurrentPassword($current_password) == true) {
          if(($img_avatar != "") && ($update_user->sameInfo($img_avatar) != true)) {
            $dir = 'ressources/img/';
            $sourcePath = $_FILES['avatar']['tmp_name'];
            $targetPath = $dir . $_FILES['avatar']['name'];

            move_uploaded_file($sourcePath,$targetPath);

            $update_user->updateImage($img_avatar);
            echo 'move';
          } else {
            array_push($this->errors, 'probleme lors de l\'update');
          }

          if(($first_name != "") && ($update_user->sameInfo($first_name) == false)) {
            if($update_user->updateFirstname($first_name) == 'updaté') {
              echo 'Success';
            } else {
              array_push($this->errors, 'probleme lors de l\'update');
            }
          }

          if(($last_name != "") && ($update_user->sameInfo($last_name) == false)) {
            if($update_user->updateLastName($last_name) == 'updaté') {
              echo 'Success';
            } else {
              array_push($this->errors, 'probleme lors de l\'update');
            }
          }

          if(($mail != "") && ($update_user->sameInfo($mail) == false)) {
            if($update_user->updateMail($mail) == 'updaté') {
              echo 'Success';
            } else {
              array_push($this->errors, 'probleme lors de l\'update');
            }
          }

          if($new_password != "" && $conf_new_password != "" && $new_password == $conf_new_password) {
            if ($update_user->updatePassword($new_password) == 'updaté') {
              echo 'Success';
            } else {
              array_push($this->errors, 'probleme lors de l\'update');
            }
          }

        } else {
          array_push($this->errors, 'Votre mot de passe est invalide');
        }
      } else {
        array_push($this->errors, 'le POST est vide');
      }
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

    public function switchPicture(){
      $pict = new User;
      if(!empty($pict->switchPicture())) {
        return $picture_profil;
      }
    }
}