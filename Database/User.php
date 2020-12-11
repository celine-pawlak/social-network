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

    public function addHobbies($hobbies){
      // pour chaque hobby dans $hobbies
      foreach($hobbies as $hobby) {
        // s'il n'existe dans la table hobby, on le créé
        $query = $this->_db->prepare("SELECT COUNT(*) FROM hobbies WHERE name = ?");
        $query->execute([$hobby]);

        if($query->fetchColumn() == 0) {
          $query = $this->_db->prepare("INSERT INTO hobbies(name) VALUES (?)");
          $query->execute([$hobby]);
        }

      }

      // on efface tous les attachements entre l'utilisateur et les hobby (DELETE FROM users_hobbies WHERE users_id = ?)
      $query = $this->_db->prepare("DELETE FROM users_hobbies WHERE users_id = ?");
      $query->execute([$this->_id]);

      // on ajoute trois attachements entre les hobby et l'user
      foreach($hobbies as $hobby) {
        $query= $this->_db->prepare("INSERT INTO users_hobbies(users_id, hobbies_id) VALUES(?, (SELECT id FROM hobbies WHERE name = ?))");
        $query->execute([$this->_id, $hobby]);
      }

    }

    public function getHobbies(){
      $query = $this->_db->prepare("SELECT * FROM users_hobbies JOIN hobbies ON users_hobbies.hobbies_id = hobbies.id WHERE users_id = ?");
      $query->execute([$this->_id]);
      $data = $query->fetchAll();
      return [
        "hobby1" => $data[0]["name"],
        "hobby2" => $data[1]["name"],
        "hobby3" => $data[2]["name"]
      ];
    }

    public function addTechnologies($technologies){
      foreach($technologies as $technology) {
        // s'il n'existe dans la table technologies, on le créé
        $query = $this->_db->prepare("SELECT COUNT(*) FROM technologies WHERE name = ?");
        $query->execute([$technology]);

        if($query->fetchColumn() == 0) {
          $query = $this->_db->prepare("INSERT INTO technologies(name) VALUES (?)");
          $query->execute([$technology]);
        }

        $query = $this->_db->prepare("DELETE FROM users_technologies WHERE users_id = ?");
        $query->execute([$this->_id]);

        foreach($technologies as $technology) {
          $query= $this->_db->prepare("INSERT INTO users_technologies(users_id, technologies_id) VALUES(?, (SELECT id FROM technologies WHERE name = ?))");
          $query->execute([$this->_id, $technology]);
        }
      }
    }

    public function getTechnologies(){
      $query = $this->_db->prepare("SELECT * FROM users_technologies JOIN technologies ON users_technologies.technologies_id = technologies.id WHERE users_id = ?");
      $query->execute([$this->_id]);
      $data = $query->fetchAll();
      return $data;
    }
}
