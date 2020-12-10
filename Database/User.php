<?php


namespace App\Database;

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

    public function __construct() {
        parent::__construct();
        $this->_db = parent::getPDO();
    }

    public function connexion($mail, $password){
        $query = $this->_db->prepare("SELECT * FROM users WHERE mail = ?");
        $query->execute([$mail]);
        $thisUser = $query->fetch();

        $_SESSION['user'] = $thisUser;
        $tab_session = [];

        array_push($tab_session, 'connecté');
        array_push($tab_session, $thisUser);

        return $tab_session;
    }

    public function inscription($mail, $prenom, $nom, $birthday, $password){
        $first_name = ucfirst(strtolower($prenom));
        $last_name = ucfirst(strtolower($nom));

        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $query = $this->_db->prepare("INSERT INTO users(mail, last_name, first_name, date_birth, password) VALUES (?, ?, ?, ?, ?)");
        $query->execute([$mail, $first_name, $last_name, $birthday, $password_hash]);

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
}