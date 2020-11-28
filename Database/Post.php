<?php


namespace App\Database;


class Post extends Database
{
    private $_id;
    private $_content;
    private $_creationDate;
    private $_idUser = 1; // Valeur temporaire à remplacer
    private $_db;

    public function __construct()
    {
        parent::__construct();
        $this->_db = parent::getPDO();
    }

    public function addPost($content)
    {
      $query = $this->_db->prepare("INSERT INTO post(content, creation_date, users_id) VALUES (?, NOW(), ?)");
      $query->execute([$content, $this->_idUser]);
    }

    public function getAllPosts()
    {
      $query = $this->_db->prepare("SELECT * FROM post WHERE users_id = ?");
      $query->execute([$this->_idUser]);

      return $query->fetchAll();
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
