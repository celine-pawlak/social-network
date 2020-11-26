<?php

namespace App\Controller;


class MessagerieController extends AppController
{

    public $errors = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function messagerie(){
        $this->render('messagerie.messagerie');
    }



}