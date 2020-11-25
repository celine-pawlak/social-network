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
    private $db;

    public function __construct()
    {
        parent::__construct();
        $db = new Database();
        $this->db = $db->getPDO();
    }



}