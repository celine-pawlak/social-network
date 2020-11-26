<?php

define('ROOT', getcwd());
session_start();
// Autoloader des Controller
require ROOT . '/Autoloader.php';
App\Autoloader::register();

$url = '';
if (isset($_GET['url'])) {
$url = explode('/', $_GET['url']);
}

if ($url == '' || $url[0] == 'index' || $url[0] == 'accueil' || $url[0] == 'index.php') {
    $controller = '\App\Controller\IndexController';
    $action = 'index';
} elseif ($url[0] == 'profil') {
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
}

$controller = new $controller;
$controller->$action();
