<?php

namespace App\Controller;

use App\Database\Post;
use App\Database\Reaction;
use App\Database\User;
use App\Database\Comment;

class ProfilController extends AppController
{
    public $errors = [];


    public function test()
    {
        echo 'MARCHE';
    }

    public function __construct()
    {
        parent::__construct();
    }
    
    public function monprofil()
    {
        $posts = new Post;
        $infosUser = new User;
        $commentaires = new Comment;
        $reacts = new Reaction;

        $id_user = $_SESSION['user']['id'];
        $posts = $posts->getAllPosts($_SESSION['user']['id']);
        foreach ($posts as $key => $post) {
            $posts[$key]['reactions'] = $reacts->getAllReactionsFromPost($post[0]);
        }
        $hobbies = $infosUser->getHobbies($_SESSION['user']['id']);
        $smileys = $reacts->getEmoji();
        $technologies = $infosUser->getTechnologies($_SESSION['user']['id']);
        $userInformations = $infosUser->getInfosUser($_SESSION['user']['id']);
        $presentation = $infosUser->getPresentation($_SESSION['user']['id']);
        $commentaires = $commentaires->getAllComment($_SESSION['user']['id']);
        $age = $infosUser->getDate($_SESSION['user']['id']);


        // méthode d'affichage des vues, reçoit en entrée le nom de la vue et les données
        $this->render('profil.seeMonProfil', compact(
            'id_user',
            'posts',
            'hobbies',
            'smileys',
            'technologies',
            'userInformations',
            'presentation',
            'commentaires',
            'age'
        ));
    }

    public function profil()
    { // Profil des autres utilisateurs
        $posts = new Post;
        $infosUser = new User;
        $commentaires = new Comment;
        $id_user = $_GET['id'];
        $reacts = new Reaction;

        $posts = $posts->getAllPosts($id_user);
        foreach ($posts as $key => $post) {
            $posts[$key]['reactions'] = $reacts->getAllReactionsFromPost($post[0]);
        }

        $hobbies = $infosUser->getHobbies($id_user);
        $smileys = $reacts->getEmoji();
        $technologies = $infosUser->getTechnologies($id_user);
        $userInformations = $infosUser->getInfosUser($id_user);
        $presentation = $infosUser->getPresentation($id_user);
        $commentaires = $commentaires->getAllComment($id_user);
        $age = $infosUser->getDate($id_user);


        // Vérif si id existe ou redirection
        if ($infosUser->isUser($id_user) == 0) {
            header("Location:index.php");
        }
        // Verif si id = session id => this mon profil
        if ($id_user == $_SESSION['user']['id']) {
            $this->monprofil();
            die;
        }

        // méthode d'affichage des vues, reçoit en entrée le nom de la vue et les données
        $this->render('profil.seeProfil', compact(
            'id_user',
            'posts',
            'hobbies',
            'smileys',
            'technologies',
            'userInformations',
            'presentation',
            'commentaires',
            'age'
        ));
    }

    public function ajouterCommentaire()
    {
        $comment = new Comment;
        $response = $comment->addComment($_POST["content"], $_POST["id_post"], $_POST["id_user"]);
        return json_encode($response);
    }

    public function setProfil()
    {
        $id_user = $_SESSION['user']['id'];
        $user = new User;
        $infos_user = $user->showProfil($id_user);

        $this->render('profil.setProfil', compact('infos_user'));
    }

    public function updateProfil()
    {

        if (isset($_POST) && !empty($_POST)) {
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
            $recup_update = [];

            if ($update_user->verifCurrentPassword($current_password) == true) {
                if (($img_avatar != "") && ($update_user->sameInfo($img_avatar) != true)) {
                    $dir = 'ressources/img/';
                    $sourcePath = $_FILES['avatar']['tmp_name'];
                    $targetPath = $dir . $_FILES['avatar']['name'];

                    move_uploaded_file($sourcePath, $targetPath);

                    $update_user->updateImage($img_avatar);
                    array_push($recup_update, 'move');
                } else {
                    array_push($this->errors, 'probleme lors de l\'update');
                }

                if (($first_name != "") && ($update_user->sameInfo($first_name) == false)) {
                    if ($update_user->updateFirstname($first_name) == 'updaté') {
                        array_push($recup_update, 'prénom updaté');
                    } else {
                        array_push($this->errors, 'probleme lors de l\'update');
                    }
                }

                if (($last_name != "") && ($update_user->sameInfo($last_name) == false)) {
                    if ($update_user->updateLastName($last_name) == 'updaté') {
                        array_push($recup_update, 'nom de famille updaté');
                    } else {
                        array_push($this->errors, 'probleme lors de l\'update');
                    }
                }

                if (($mail != "") && ($update_user->sameInfo($mail) == false)) {
                    if ($update_user->updateMail($mail) == 'updaté') {
                        array_push($recup_update, 'mail updaté');
                    } else {
                        array_push($this->errors, 'probleme lors de l\'update');
                    }
                }

                if ($new_password != "" && $conf_new_password != "" && $new_password == $conf_new_password) {
                    if ($update_user->updatePassword($new_password) == 'updaté') {
                        array_push($recup_update, 'new mdp');
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
        $result = json_encode($recup_update);
        echo $result;
    }

    public function addPostForm()
    {
        $infosUser = new User;
        // Si un formulaire a été envoyé, on ajoute la publication
        if (isset($_POST["post_profil"]) && !empty($_POST['post_profil'])) {
            $post = new Post;
            $content = $_POST["post_profil"];
            $user_id = $_SESSION['user']['id'];
            $post->addPost($content, $user_id);
            echo 'Success';
        }

        // $posts = new Post;
        // // On affiche le profil
        // $this->render('profil.seeProfil', [
        //   "posts" => $posts->getAllPosts($_SESSION['user']['id']),
        //   "hobbies" => $infosUser->getHobbies($_SESSION['user']['id']),
        //   "reacts" => $posts->getReacts($_SESSION['user']['id']),
        //   "technologies" => $infosUser->getTechnologies($_SESSION['user']['id']),
        //   "infosUser" => $infosUser->getInfosUser($_SESSION['user']['id']),
        //   "presentation" => $infosUser->getPresentation($_SESSION['user']['id'])
        // ]);
    }

    public function rechargePosts()
    {
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            $post = new Post;
            $id = $_SESSION['user']['id'];
            $post->getAllPosts($id);
        }
    }

    public function addHobbies()
    {

        $hobbies = new User;
        $hobbies->addHobbies([$_POST["hobby1"], $_POST["hobby2"], $_POST["hobby3"]], $_SESSION['user']['id']);

    }

    public function addTechnologies()
    {

        $technologies = new User;
        $technologies->addTechnologies([$_POST["tech1"], $_POST["tech2"], $_POST["tech3"]], $_SESSION['user']['id']);

    }

    public function updatePresentation()
    {
        $presentation = new User;
        $presentation->updatePresentation($_POST['presentation'], $_SESSION['user']['id']);
    }

    public function switchPicture()
    {
        $pict = new User;
        if (!empty($pict->switchPicture())) {
            return $picture_profil;
        }
    }

    public function getAge($id)
    {
        $user = new User;
        var_dump($user->getAge($id));
    }
}