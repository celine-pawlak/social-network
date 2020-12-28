<?php


namespace App\Database;

use \PDO;

class Message extends Conversation
{
    private $_id;
    private $_content;
    private $_creationDate;
    private $_userId;
    private $_conversationId;
    private $_db;

    public function __construct()
    {
        parent::__construct();
        $this->_db = parent::getPDO();
    }

    public function getAllMessagesFromConversation($id_conversation)
    {
        $query = $this->_db->prepare("SELECT messages.id, messages.content, messages.creation_date, messages.users_id, users.first_name, users.last_name, users.picture_profil
            FROM messages
            LEFT JOIN users ON messages.users_id = users.id
            WHERE conversations_id = :conversation_id
            ORDER BY `creation_date`
            ");
        $query->execute([':conversation_id' => $id_conversation]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Send a new message in an existing conversation
     * @param $id_user
     * @param $content
     * @param $id_conversation
     */
    public function sendMessage($id_user, $content, $id_conversation){
        $query = $this->_db->prepare("INSERT INTO messages (content, users_id, conversations_id) VALUES (:content, :user_id, :conversation_id)");
        $query->execute([
            ':content' => $content,
            ':user_id' => $id_user,
            ':conversation_id' => $id_conversation
        ]);
        return [
            'content' => $content,
            'users_id' => $id_user,
            'id_conversations' => $id_conversation,
            'id' => $this->_db->lastInsertId(),
            'creation_date' => date("Y-m-d H:i:s")
        ];
    }

    public function getMessageInformations($id_message){
        $query = $this->_db->prepare("SELECT * FROM messages WHERE id = :idMessage");
        $query->execute([
            ':idMessage' => $id_message
        ]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }


}