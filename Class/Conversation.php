<?php


namespace App\Database;


class Conversation extends Database
{
    private $_id;
    private $_idCreator;
    private $_name;
    private $_db;

    public function __construct()
    {
        parent::__construct();
        $this->_db = parent::getPDO();
    }

    public function id()
    {
        return $this->_id;
    }

    public function idCreator()
    {
        return $this->_idCreator;
    }

    public function name()
    {
        return $this->_name;
    }
}
