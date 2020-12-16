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

    /**
     * Return all emojis
     * @return array
     */
    public function getEmoji()
    {
        $requete = $this->_db->query("SELECT * FROM reacts");
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertEmoji($id_user, $id_react, $id_bloc, $bloc)
    {
        $nom_bloc = $bloc . '_id';
        $req = $this->_db->prepare("SELECT * FROM users_reacts WHERE users_id=? AND $nom_bloc=?");
        $req->execute([$id_user, $id_bloc]);
        $hasReact = $req->fetch(PDO::FETCH_ASSOC);
        if (!empty($hasReact)) {
            if ($hasReact['reacts_id'] == $id_react) {
                $delete = $this->_db->prepare("DELETE FROM users_reacts WHERE users_id=? AND $nom_bloc=?");
                $delete->execute([$id_user, $id_bloc]);
            } else {
                $update = $this->_db->prepare("UPDATE users_reacts SET reacts_id=? WHERE id=?");
                $update->execute([$id_react, $hasReact['id']]);
            }
        } else {
            $requete = $this->_db->prepare("INSERT INTO users_reacts (users_id, reacts_id, $nom_bloc) VALUES (?, ?, ?)");
            $requete->execute([$id_user, $id_react, $id_bloc]);
        }
    }

    /**
     * Get user and reaction informations from a message
     * @param $id_message
     * @return array
     */
    public function getAllReactionsFromMessage($id_message)
    {
        $query = $this->_db->prepare("SELECT users_reacts.id as react_id, reacts.id, reacts.type, reacts.emoji, users_reacts.messages_id, users_reacts.users_id as user_id, users.first_name, users.last_name, users.picture_profil
            FROM reacts
            LEFT JOIN users_reacts ON reacts.id = users_reacts.reacts_id
            LEFT JOIN users ON users_reacts.users_id = users.id
            WHERE users_reacts.messages_id = :id_message");
        $query->execute([':id_message' => $id_message]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}

