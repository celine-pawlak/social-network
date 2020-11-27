<?php


namespace App\Database;


class Message extends Conversation
{
    private $_db;

    public function __construct()
    {
        parent::__construct();
        $this->_db = parent::getPDO();
    }

}