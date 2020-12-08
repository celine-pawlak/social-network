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
            LIMIT 15");
        $query->execute([':conversation_id' => $id_conversation]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


}