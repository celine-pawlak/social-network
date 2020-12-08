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

    public function addHobbies($content){
      // Doit insérer le hobby dans la table s'il n'existe pas déjà
      // Faire une requête qui cherche si $content est déjà dans la table hobby1
      // Si le résultat est 0, insérer dans la table
      $query = $this->_db->prepare("INSERT INTO hobbies(name) VALUES (?)");
      $query->execute([$content]);

      // Doit associer l'id de l'utilisateur à l'id du hobby dans la table de liaison user_hobby
    }


}
