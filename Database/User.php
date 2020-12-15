<?php


namespace App\Database;

use PDO;

class User extends Database
{
    private $_id;
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


    public function connexion($mail, $password){
        $query = $this->_db->prepare("SELECT id, mail, last_name, first_name, picture_profil, picture_cover, date_birth FROM users WHERE mail = ?");
        $query->execute([$mail]);
        $thisUser = $query->fetch();

        $_SESSION['user'] = $thisUser;
        $tab_session = [];

        array_push($tab_session, 'connecté');
        array_push($tab_session, $thisUser);

        $this->_id = $thisUser['id'];
        $this->_mail = $thisUser['mail'];
        $this->_last_name = $thisUser['last_name'];
        $this->_first_name = $thisUser['first_name'];
        $this->_picture_profil = $thisUser['picture_profil'];
        $this->_picture_cover = $thisUser['picture_cover'];
        $this->_date_birth = $thisUser['date_birth'];

        return $tab_session;
    }

    public function inscription($mail, $prenom, $nom, $birthday, $password){
        $first_name = ucfirst(strtolower($prenom));
        $last_name = ucfirst(strtolower($nom));

        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $query = $this->_db->prepare("INSERT INTO users(mail, last_name, first_name, date_birth, password) VALUES (?, ?, ?, ?, ?)");
        $query->execute([$mail, $last_name, $first_name, $birthday, $password_hash]);

        return 'Success';
    }

    public function isExist($mail){
        $query = $this->_db->prepare("SELECT * FROM users WHERE mail = ?");
        $query->execute([$mail]);
        $result = $query->fetch();

        if(empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    public function isSamepassword($password, $conf_pw){
        if($password == $conf_pw){
            return true;
        } else {
            return false;
        }
    }

    public function isGoodpassword($mail, $password){
        $query = $this->_db->prepare("SELECT password FROM users WHERE mail = ?");
        $query->execute([$mail]);
        $result = $query->fetch();

        $db_password = $result['password'];

        if(password_verify($password, $db_password) == true) {
            return true;
        } else {
            return false;
        }
    }

    public function search()
        {
            $requete = $this->_db->query("SELECT first_name, last_name, id FROM users");
            $tableau = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $tableau;
        }



    public function getInfosUser($id){
      $query = $this->_db->prepare("SELECT * FROM users WHERE id = ?");
      $query->execute([$id]);

      return $query->fetchAll();
    }

    public function addHobbies($hobbies, $id){
      // pour chaque hobby dans $hobbies
      foreach($hobbies as $hobby) {
        // s'il n'existe dans la table hobby, on le créé
        $query = $this->_db->prepare("SELECT COUNT(*) FROM hobbies WHERE name_hobby = ?");
        $query->execute([$hobby]);

        if($query->fetchColumn() == 0) {
          $query = $this->_db->prepare("INSERT INTO hobbies(name_hobby) VALUES (?)");
          $query->execute([$hobby]);
        }
      }

      // on efface tous les attachements entre l'utilisateur et les hobby (DELETE FROM users_hobbies WHERE users_id = ?)
      $query = $this->_db->prepare("DELETE FROM users_hobbies WHERE users_id = ?");
      $query->execute([$id]);

      // on ajoute trois attachements entre les hobby et l'user
      foreach($hobbies as $hobby) {
        $query= $this->_db->prepare("INSERT INTO users_hobbies(users_id, hobbies_id) VALUES(?, (SELECT id FROM hobbies WHERE name_hobby = ?))");
        $query->execute([$id, $hobby]);
      }
    }

    public function getHobbies($id){

      # requête qui retourne le nombre de hobby dans $nb_hobbies
      $query = $this->_db->prepare("SELECT COUNT(*) FROM users_hobbies WHERE users_id = ?");
      $query->execute([$id]);

      $nb_hobbies = $query->fetchColumn();

      if($nb_hobbies > 0) {
        # Si il y a des hobbies rattaché à l'utilisateur
        $query = $this->_db->prepare("SELECT * FROM users_hobbies JOIN hobbies ON users_hobbies.hobbies_id = hobbies.id WHERE users_id = ?");
        $query->execute([$id]);
        $data = $query->fetchAll();
        $tableau = [
          "hobby1" => $data[0]["name_hobby"],
          "hobby2" => $data[1]["name_hobby"],
          "hobby3" => $data[2]["name_hobby"]
        ];
      } else {
        $tableau = [
          "hobby1" => "",
          "hobby2" => "",
          "hobby3" => ""
        ];
      }
      return $tableau;

    }

    public function addTechnologies($technologies, $id){
      foreach($technologies as $technology) {
        // s'il n'existe dans la table technologies, on le créé
        $query = $this->_db->prepare("SELECT COUNT(*) FROM technologies WHERE name_technology = ?");
        $query->execute([$technology]);

        if($query->fetchColumn() == 0) {
          $query = $this->_db->prepare("INSERT INTO technologies(name_technology) VALUES (?)");
          $query->execute([$technology]);
        }

        $query = $this->_db->prepare("DELETE FROM users_technologies WHERE users_id = ?");
        $query->execute([$id]);

        foreach($technologies as $technology) {
          $query= $this->_db->prepare("INSERT INTO users_technologies(users_id, technologies_id) VALUES(?, (SELECT id FROM technologies WHERE name_technology = ?))");
          $query->execute([$id, $technology]);
        }
      }
    }

    public function getTechnologies($id){
        $query = $this->_db->prepare("SELECT COUNT(*) FROM users_technologies WHERE users_id = ?");
        $query->execute([$id]);

        $nb_technologies = $query->fetchColumn();

        if($nb_technologies > 0) {
          $query = $this->_db->prepare("SELECT * FROM users_technologies JOIN technologies ON users_technologies.technologies_id = technologies.id WHERE users_id = ?");
          $query->execute([$id]);
          $data = $query->fetchAll();
          $tableau = [
            "tech1" => $data[0]["name_technology"],
            "tech2" => $data[1]["name_technology"],
            "tech3" => $data[2]["name_technology"]
          ];

        }else{
          $tableau = [
            "tech1" => "",
            "tech2" => "",
            "tech3" => ""
          ];
        }
        return $tableau;
    }

    public function updatePresentation($presentation, $id){
        $query = $this->_db->prepare("UPDATE users SET presentation = ? WHERE id = ?");
        $query->execute([$presentation, $id]);
    }

    public function getPresentation($id){
        $query = $this->_db->prepare("SELECT presentation FROM users WHERE id = ?");
        $query->execute([$id]);
        $data = $query->fetch();
        return $data;
    }

    public function deco(){
        unset($_SESSION['user']);
        echo 'disconnect';
    }

    public function showProfil($id_user){
        $query = $this->_db->prepare("SELECT * FROM users WHERE id = ? ");
        $query->execute([$id_user]);
        $infos = $query->fetch();

        return $infos;
    }
}
