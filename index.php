<?php

define('ROOT', getcwd()); // On assigne à la constante ROOT le dossier de travail courant grâce à la fonction getcwd()
// session_start();

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
        $action = 'monprofil';
        $controller = '\App\Controller\ProfilController';
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
    }elseif($url[0] == "profil") {
        $action = "profil";
        $controller = '\App\Controller\ProfilController';
    }
  }

$controller = new $controller;
$controller->$action();
