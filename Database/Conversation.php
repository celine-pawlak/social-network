<?php


namespace App\Database;

use \PDO;

class Conversation extends Database
{
    private $_id;
    private $_idCreator;
    private $_name;
    private $_db;

    public function __construct()
    {
        parent::__construct();
        $this->_db = parent::getPDO();
    }

    /**
     * Récupère toutes les conversations du user avec le dernier message envoyé
     * Range les conversations dans l'ordre du dernier message envoyé
     * @param $id_user
     * @return array
     */

    public function allConversationsWithLastMessageSent($id_user)
    {
        $query = $this->_db->prepare("
            SELECT conversations.id as conversation_id, conversations.name, conversations.creator_id, conversations.image,
	            (SELECT messages.content
                FROM messages
                WHERE messages.conversations_id =  conversation_id
                ORDER BY messages.creation_date DESC LIMIT 1) as message_content
            FROM conversations
            LEFT JOIN users_conversations ON conversations.id = users_conversations.conversations_id
            LEFT JOIN messages ON users_conversations.conversations_id = messages.conversations_id
            WHERE users_conversations.users_id = :userId
            GROUP BY users_conversations.conversations_id
            ORDER BY messages.creation_date DESC");
        $query->execute([':userId' => $id_user]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function usersFromConversationInformations($id_conversation){
        $query = $this->_db->prepare("
        SELECT users.id, users.first_name, users.last_name, users.picture_profil
        FROM users
        LEFT JOIN users_conversations ON users.id = users_conversations.users_id
        WHERE users_conversations.conversations_id = :conversationId
        ORDER BY users.first_name");
        $query->execute(['conversationId' => $id_conversation]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function id()
    {
        return $this->_id;
    }

    public function idCreator()
    {
        return $this->_idCreator;
    }

    public function name()
    {
        return $this->_name;
    }
}
