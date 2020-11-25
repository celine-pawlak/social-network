<?php


namespace App\Database;


class Comment extends Database
{
    private $_id;
    private $_content;
    private $_creation_date;
    private $_user_id;
    private $_db;

    public function __construct()
    {
        parent::__construct();
        $db = new Database();
        $this->_db = $db->getPDO();
    }

    public function showComment()
    {

    }

    public function addComment()
    {

    }

    public function id()
    {
        return $this->_id;
    }

    public function content()
    {
        return $this->_content;
    }

    public function creation_date()
    {
        return $this->_creation_date;
    }

    public function user_id()
    {
        return $this->_user_id;
    }

    public function setContent($content)
    {
        $this->_content = $content;
    }
}