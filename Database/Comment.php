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

    public function getAllComment($user_id) {
      // télécharger tous les posts de l'user
      $posts = $this->_db->prepare("SELECT * FROM post WHERE users_id = ?");
      $posts->execute([$user_id]);

      // télécharger tous les commentaires de ces posts
      $tableau = [];
      while($post = $posts->fetch()) {
        $comments = $this->_db->prepare("SELECT * FROM comments WHERE posts_id = ?");
        $comments->execute([$post["id"]]);
        $tableau["post_".$post["id"]] = $comments->fetchAll();
      }

      return $tableau;


    }

    public function getCommentPost($post_id)
    {
      $query = $this->_db->prepare("SELECT * FROM comments WHERE posts_id = ? ORDER BY date_creation DESC");
      $query->execute([$post_id]);

      return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addComment($content, $post_id, $user_id)
    {
      $query = $this->_db->prepare("INSERT INTO comments(content, creation_date, user_id, posts_id) VALUES (?, NOW(), ?, ?)");
      $query->execute([$content, $post_id, $user_id]);
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
