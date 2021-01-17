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

    public function usersFromConversationInformations($id_conversation)
    {
        $query = $this->_db->prepare("
        SELECT users.id, users.first_name, users.last_name, users.picture_profil
        FROM users
        LEFT JOIN users_conversations ON users.id = users_conversations.users_id
        WHERE users_conversations.conversations_id = :conversationId
        ORDER BY users.first_name");
        $query->execute(['conversationId' => $id_conversation]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isCreator($id_user, $id_conversation)
    {
        $query = $this->_db->prepare("SELECT * FROM conversations WHERE creator_id = :creator_id AND id = :conversation_id");
        $query->execute([
            ':creator_id' => $id_user,
            ':conversation_id' => $id_conversation
        ]);
        if (empty($query->fetchAll())) {
            return false;
        }
        return true;
    }

    public function updateName($id_conversation, $new_conversation_name)
    {
        $query = $this->_db->prepare("UPDATE conversations SET name = :new_conversation_name WHERE id = :conversation_id");
        $query->execute([
            ':new_conversation_name' => $new_conversation_name,
            ':conversation_id' => $id_conversation
        ]);
    }

    public function isDuo($id_conversation)
    {
        $query = $this->_db->prepare("SELECT * FROM users_conversations WHERE conversations_id = :conversation_id");
        $query->execute([
            ':conversation_id' => $id_conversation
        ]);
        $conversation = $query->fetchAll();
        if (count($conversation) > 2) {
            return false;
        }
        return $conversation;
    }

    public function isMember($user_id, $id_conversation)
    {
        $query = $this->_db->prepare("SELECT * FROM users_conversations WHERE (conversations_id = :conversation_id AND users_id = :user_id)");
        $query->execute([
            ':conversation_id' => $id_conversation,
            ':user_id' => $user_id
        ]);
        if (empty($query->fetchAll())) {
            return false;
        }
        return true;
    }

    public function addMember($id_conversation, $new_member_id)
    {
        $query = $this->_db->prepare("INSERT INTO users_conversations (conversations_id, users_id) VALUES (:conversation_id, :user_id)");
        $query->execute([
            ':conversation_id' => $id_conversation,
            ':user_id' => $new_member_id
        ]);
        return $id_conversation;
    }

    public function newConversation($creator_id, $users_id)
    {
        $query = $this->_db->prepare("INSERT INTO conversations (creator_id) VALUES (:creator_id)");
        $query->execute([
            ':creator_id' => $creator_id
        ]);
        $latest_id = $this->_db->lastInsertId();
        foreach ($users_id as $user_id) {
            $query2 = $this->_db->prepare("INSERT INTO users_conversations (users_id, conversations_id) VALUES (:user_id, :conversation_id)");
            $query2->execute([
                ':user_id' => $user_id,
                ':conversation_id' => $latest_id
            ]);
        }
        return $latest_id;
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
