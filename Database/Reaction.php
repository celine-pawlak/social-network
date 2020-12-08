<?php

namespace App\Database;
use \PDO;
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
                // $emoji =['like' =>'👍', 'adore' => '❤️', 'bravo' => ' 👏'];            
                $requete = $this->_db->query("SELECT * FROM reacts");
                $emoji = $requete->fetchAll(PDO::FETCH_ASSOC);                
                return json_encode($emoji);                
            }
        public function insertEmoji($id_user, $id_react, $id_bloc, $bloc)
            {
                $nom_bloc = $bloc.'_id';
                $requete = $this->_db->prepare("INSERT INTO users_reacts (users_id, reacts_id, $nom_bloc) VALUES (?, ?, ?)");
                $requete->execute([$id_user, $id_react, $id_bloc]);
            }
    }



?>