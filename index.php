<?php

define('ROOT', getcwd()); // On assigne à la constante ROOT le dossier de travail courant grâce à la fonction getcwd()
session_start();
// Autoloader des Controller
require ROOT . '/Autoloader.php';
App\Autoloader::register();

$url = '';
if (isset($_GET['url'])) {
$url = explode('/', $_GET['url']); // explode permet de séparer les paramètres et de générer un tableau
}

if ($url == '' || $url[0] == 'index' || $url[0] == 'accueil' || $url[0] == 'index.php') {
    $action = 'index'; // une action dans l'url est une méthode dans le contrôleur
    $controller = '\App\Controller\IndexController';
} elseif ($url[0] == 'profil' || $url[0] == 'profil.php' || $url[0] == 'seeProfil.php') {
    $action = 'profil';
    $controller = '\App\Controller\ProfilController';
}elseif ($url[0] == 'wall') {
    $action = 'wall';
    $controller = '\App\Controller\ProfilController';
}elseif ($url[0] == 'messagerie') {
    $action = 'messagerie';
    $controller = '\App\Controller\MessagerieController';
}elseif ($url[0] == 'messagerie/create') {
    $action = 'creermessagerie';
    $controller = '\App\Controller\MessagerieController';
} elseif($url[0] == "addPostForm") {
  $action = "addPostForm";
  $controller = '\App\Controller\ProfilController';
} elseif($url[0] == "addHobbies") {
  $action = "addHobbies";
  $controller = '\App\Controller\ProfilController';
}elseif($url[0] == "addTechnologies") {
  $action = "addTechnologies";
  $controller = '\App\Controller\ProfilController';
}

$controller = new $controller;
$controller->$action();

/*
$controller = "App\Controller\\".ucfirst($url[0])."Controller";
$action = isset($url[1]) ? $url[1] : "index";

if(method_exists($controller, $action)) {

  unset($url[0]);
  unset($url[1]);

  call_user_func_array([$controller, $action], $url);

}
*/
