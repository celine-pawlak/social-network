<?php


namespace App\Database;

class User extends Database
{
    private $_id = 1; // à remplacer plus tard
    private $_mail;
    private $_family_name;
    private $_first_name;
    private $_picture_profil;
    private $_picture_cover;
    private $_date_birth;
    private $_hobbies = [];
    private $_technologies = [];
    private $_db;

    public function __construct()
    {
        parent::__construct();
        $this->_db = parent::getPDO();
    }

    public function getInfosUser(){
      $query = $this->_db->prepare("SELECT * FROM users WHERE id = ?");
      $query->execute([$this->_id]);

      return $query->fetchAll();
    }


}
