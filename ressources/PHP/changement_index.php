<?php
    if(isset($_POST['url']) && !empty($_POST['url'])) {
        $controller = '\App\Controller\IndexController';
        $action = 'inscription';

        $controller = new $controller;
        $controller->$action();
    }

?>

