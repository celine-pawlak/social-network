<?php

namespace App\Database;

class Reaction extends Database
    {
        private $_db;

        public function __construct()
            {
                parent::__construct();
                $db = new Database();
                $this->_db = $db->getPDO();
            }
        public function setReaction()
            {

            }
        public function getReaction()
            {

            }
        public function getEmoji()
            {      
                $emoji =['like' =>'👍', 'adore' => '❤️', 'bravo' => ' 👏'];            
                // $requete = $this->_db->query("SELECT * FROM reacts");
                // $getEmoji = $requete->fetchAll();                
                return json_encode($emoji);                
            }
        public function insertEmoji()
            {
                echo 'insérer';
            }
    }



?>