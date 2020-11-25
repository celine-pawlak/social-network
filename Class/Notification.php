<?php


namespace App\Database;


class Notification extends Database
{
    private $_id;
    private $isRead = false;
    private $_db;

    public function __construct()
    {
        parent::__construct();
        $db = new Database();
        $this->_db = $db->getPDO();
    }

    public function showNotifications(){

    }

    public function _id(){

    }

}