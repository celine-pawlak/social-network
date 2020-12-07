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
                $requete = $this->_db->query("SELECT * FROM reacts");
                $getEmoji = $requete->fetchAll();
                return $getEmoji;
                // echo json_encode($getEmoji);
            }
    }



?>