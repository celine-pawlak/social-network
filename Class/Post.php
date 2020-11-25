<?php


namespace App\Database;


class Post extends Database
{
    private $_id;
    private $_content;
    private $_creationDate;
    private $_idUser;
    private $_db;

    public function __construct()
    {
        parent::__construct();
        $db = new Database();
        $this->_db = $db->getPDO();
    }

    public function addPost()
    {

    }

    public function showPost()
    {

    }

    /**
     * Getter Post ID
     * @return mixed
     */
    public function id()
    {
        return $this->_id;
    }

    /**
     * Getter Post Content
     * @return mixed
     */
    public function content()
    {
        return $this->_content;
    }

    /**
     * Getter Post Creation Date
     * @return mixed
     */
    public function creationDate()
    {
        return $this->_creationDate;
    }

    /**
     * Getter Post id User
     * @return mixed
     */
    public function idUser()
    {
        return $this->_idUser;
    }

    /**
     * Setter Post Content
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->_content = $content;
    }

    /**
     * Setter Post Creation Date
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->_creationDate = $creationDate;
    }

    /**
     * Setter Post Id User
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->_idUser = $idUser;
    }
}