<?php


namespace App\Database;


class Comment extends Post
{
    private $_id;
    private $_content;
    private $_creationDate;
    private $_userId;
    private $_db;

    public function __construct()
    {
        parent::__construct();
        $this->_db = parent::getPDO();
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

    public function creationDate()
    {
        return $this->_creationDate;
    }

    public function userId()
    {
        return $this->_userId;
    }

    public function setContent($content)
    {
        $this->_content = $content;
    }
}