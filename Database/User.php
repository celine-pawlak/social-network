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

    public function search()
        {
            $requete = $this->_db->query("SELECT first_name, last_name FROM users");
            $tableau = $requete->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($tableau);
        }

}