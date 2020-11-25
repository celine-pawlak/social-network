<?php


namespace App\Database;


class Notification extends Database
{
    private $_id;
    private $_isRead = false;
    private $_db;

    public function __construct()
    {
        parent::__construct();
        $db = new Database();
        $this->_db = $db->getPDO();
    }

    public function showNotifications()
    {

    }

    public function id()
    {
        return $this->_id;
    }

    public function isRead()
    {
        return $this->_isRead;
    }

    public function setIsRead()
    {
        return $this->_isRead;
    }

}