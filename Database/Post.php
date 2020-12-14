<?php


namespace App\Database;


class Post extends Database
{
    private $_id;
    private $_content;
    private $_creationDate;
    private $_idUser = 7 ; // Récupérer l'id de l'user connecté
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
      $query = $this->_db->prepare("SELECT *, DATE_FORMAT(creation_date, 'Posté le %d/%m/%Y à %H:%i') FROM post
        JOIN users on post.users_id = users.id WHERE users.id = ? ORDER BY post.id DESC");
      $query->execute([$this->_idUser]);

      return $query->fetchAll();
    }

    public function getReacts($id){
      $query = $this->_db->prepare("SELECT * FROM users_reacts
        JOIN reacts on users_reacts.reacts_id = reacts.id WHERE users_reacts.users_id = ?");
      $query->execute([$id]);

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
