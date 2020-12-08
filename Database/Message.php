<?php


namespace App\Database;


class Message extends Conversation
{
    private $_id;
    private $_content;
    private $_creationDate;
    private $_userId;
    private $_conversationId;
    private $_db;

    public function __construct()
    {
        parent::__construct();
        $this->_db = parent::getPDO();
    }




}