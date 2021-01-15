<?php
session_start();

define('ROOT', getcwd()); // On assigne à la constante ROOT le dossier de travail courant grâce à la fonction getcwd()
// la constante URL contient "http://localhost/social-network/"
define('URL', $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["SERVER_NAME"].str_replace('index.php','',$_SERVER['PHP_SELF']));

// Autoloader des Controller
require ROOT . '/Autoloader.php';
App\Autoloader::register();

$url = '';
if (isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);
}

if ($url!= '' && $url[0] == 'App' && $url[1] == 'Controller') {
    if (isset($_POST['action'])) {
        $controller = '\App\Controller\\'.$url[2];
        $action = $_POST['action'];
    }
} else {
    if ($url == '' || $url[0] == 'index' || $url[0] == 'accueil' || $url[0] == 'index.php') {
        $action = 'index';
        $controller = '\App\Controller\IndexController';
    } elseif ($url[0] == 'monprofil') {
      if(isset($_SESSION['user']['id'])){
        $action = 'monprofil';
        $controller = '\App\Controller\ProfilController';
      }else{
        $action = "index";
        $controller = '\App\Controller\IndexController';
      }

    } elseif ($url[0] == 'wall') {
        $action = 'wall';
        $controller = '\App\Controller\ProfilController';
    } elseif ($url[0] == 'messagerie') {
        $action = 'messagerie';
        $controller = '\App\Controller\MessagerieController';
    } elseif ($url[0] == 'messagerie/create') {
        $action = 'creermessagerie';
        $controller = '\App\Controller\MessagerieController';
    }elseif($url[0] == "addPostForm") {
        $action = "addPostForm";
        $controller = '\App\Controller\ProfilController';
    }elseif($url[0] == "addPostFormWall") {
        $action = "addPostFormWall";
        $controller = '\App\Controller\IndexController';
    } elseif($url[0] == "addHobbies") {
        $action = "addHobbies";
        $controller = '\App\Controller\ProfilController';
    }elseif($url[0] == "addTechnologies") {
        $action = "addTechnologies";
        $controller = '\App\Controller\ProfilController';
    }elseif($url[0] == "updatePresentation") {
        $action = "updatePresentation";
        $controller = '\App\Controller\ProfilController';
    }elseif($url[0] == "modifier_profil") {
        $action = "setProfil";
        $controller = '\App\Controller\ProfilController';
    }elseif($url[0] == "ajouterCommentaire") {
        $action = "ajouterCommentaire";
        $controller = '\App\Controller\ProfilController';
    }elseif($url[0] == "ajouterCommentaireWall") {
        $action = "ajouterCommentaireWall";
        $controller = '\App\Controller\IndexController';
    }elseif($url[0] == "profil") {
        $action = "profil";
        $controller = '\App\Controller\ProfilController';
    }
    else {
      $action = 'index';
      $controller = '\App\Controller\IndexController';
    }
  }

$controller = new $controller;

if(isset($url[1])) {
  unset($url[0]);
  call_user_func_array([$controller,$action], $url);
} else {
  $controller->$action();
}

?>