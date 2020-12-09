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
                $req = $this->_db->prepare("SELECT * FROM users_reacts WHERE users_id=? AND $nom_bloc=?");
                $req->execute([$id_user, $id_bloc]);
                $hasReact = $req->fetch(PDO::FETCH_ASSOC);                
                if(!empty($hasReact))
                    {
                        if($hasReact['reacts_id']==$id_react)
                            {
                                $delete = $this->_db->prepare("DELETE FROM users_reacts WHERE users_id=? AND $nom_bloc=?");
                                $delete->execute([$id_user, $id_bloc]);
                            }
                        else
                            {
                                $update = $this->_db->prepare("UPDATE users_reacts SET reacts_id=? WHERE $nom_bloc=?");
                                $update->execute([$id_react, $id_bloc]);
                            }
                    }
                else    
                    {
                        $requete = $this->_db->prepare("INSERT INTO users_reacts (users_id, reacts_id, $nom_bloc) VALUES (?, ?, ?)");
                        $requete->execute([$id_user, $id_react, $id_bloc]);                        
                    }                                                
            }        
    }



?>