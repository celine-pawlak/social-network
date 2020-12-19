<?php

namespace App\Controller;

use App\Database\Conversation;
use App\Database\Message;
use App\Database\Reaction;

class MessagerieController extends AppController
{

    public $errors = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function messagerie()
    {
        $idUser = $_SESSION['user']['id'];  // A MODIFIER QUAND SESSION DEFINIE

        $allconversationsInformations = null;
        $last_messages = null;
        $conversations = new Conversation;
        $reacts = new Reaction;
        $messages = new Message;
        $id_conversation = null;


        // Si ajout d'une reaction
        if (isset($_POST['add_reaction_message']) && !empty($_POST['add_reaction_message'])) {
            $this->addReaction($_POST['add_reaction_message'], $idUser);
        }

        // Si ajout d'un message
        if (isset($_POST['add_message']) && !empty($_POST['add_message'])) {
            $this->addMessage($_POST['add_message'], $_POST['new_message_content'], $idUser);
        }

        // Si modification du name
        if (isset($_POST['update_conversation_name']) && !empty($_POST['update_conversation_name'])) {
            $this->updateConversationName($_POST['update_conversation_name'], $_POST['new_conversation_name'], $idUser);
        }

        // Si ajout d'un membre
        if (isset($_POST['add_member_to_conversation']) && !empty($_POST['add_member_to_conversation'])) {
            $this->addMember($_POST['new_member_id'], $_POST['add_member_to_conversation'], $idUser);
        }

        $allconversations = $conversations->allConversationsWithLastMessageSent($idUser);        
        foreach ($allconversations as $key => $conversation) {
            $allconversations[$key]['users_informations'] = $conversations->usersFromConversationInformations($conversation['conversation_id']);
        }
        $allconversationsInformations = $this->getConversationsInformations($allconversations, $idUser);        
        if ($allconversationsInformations != null) {
            $id_conversation = $allconversations[0]['conversation_id'];
            if (isset($_POST['seeConversation']) && !empty($_POST['seeConversation'])) {
                $id_conversation = $_POST['seeConversation'];
            }
            $last_messages = $messages->getAllMessagesFromConversation($id_conversation);

            foreach ($last_messages as $key => $message) {
                $last_messages[$key]['reactions'] = $reacts->getAllReactionsFromMessage($message['id']);
            }
        }

        $smileys = $reacts->getEmoji();

        $this->render('messagerie.messagerie', compact('allconversationsInformations', 'last_messages', 'idUser', 'id_conversation', 'smileys'));
    }

    public function addReaction($message_and_react_id, $idUser)
    {
        $reacts = new Reaction;
        $reaction = explode('.', $message_and_react_id);
        $message_id = $reaction[0];
        $react_id = $reaction[1];
        $reacts->insertEmoji($idUser, $react_id, $message_id, 'messages');
    }

    public function addMessage($conversation_id, $content, $idUser)
    {
        $messages = new Message;
        $message_content = htmlspecialchars($content);
        $messages->sendMessage($idUser, $message_content, $conversation_id);
    }

    public function updateConversationName($conversation_id, $new_conversation_name, $idUser)
    {
        $conversations = new Conversation;
        $conversation_name = htmlspecialchars($new_conversation_name);
        if ($conversations->isCreator($idUser, $conversation_id)) {
            $conversations->updateName($conversation_id, $conversation_name);
        }
    }

    public function newConversation($id_new_group_members, $idUser)
    {
        if (count($id_new_group_members) == 1) {
            if ($id_new_group_members[0] == $idUser) {
                return;
            }
        }
        $conversations = new Conversation;
        $conversations->newConversation($idUser, $id_new_group_members);
    }

    public function addMember($new_member_id, $conversation_id, $idUser)
    {
        $conversations = new Conversation;
        // Si conversation duo créer nouvelle conversation
        $new_group_members = $conversations->isDuo($conversation_id);
        if ($new_group_members && (!$conversations->isMember($new_member_id, $conversation_id))) {
            foreach ($new_group_members as $new_group_member) {
                $id_new_group_members[] = $new_group_member['users_id'];
            }
            $id_new_group_members[] = $new_member_id;
            //nouvelle conversation avec les deux users + le nouveau
            $this->newConversation($id_new_group_members, $idUser);
        } else {
            // Sinon ajouter membre
            if ($conversations->isCreator($idUser, $conversation_id) && (!$conversations->isMember($new_member_id, $conversation_id))) {
                $conversations->addMember($conversation_id, $new_member_id);
            }
        }
    }

    public function getConversationsInformations($allconversations, $idUser)
    {
        $allconversationsInformations = [];
        foreach ($allconversations as $conversation) {
            $image_conversation = 'default_conversation_image.png';
            $name_conversation = 'default';
            if (count($conversation['users_informations']) > 2) {
                // Définit image de la conversation multiple
                if (!empty($conversation['image']) && $conversation['image'] != null) {
                    $image_conversation = $conversation['image'];
                }
                // Définit nom de la conversation multiple
                if (!empty($conversation['name']) && $conversation['name'] != null) {
                    $name_conversation = $conversation['name'];
                } else {
                    $name_conversation = '';
                    for ($i = 0; $i < count($conversation['users_informations']); $i++) {
                        $name_conversation .= $conversation['users_informations'][$i]['first_name'] . ' ' . $conversation['users_informations'][$i]['last_name'];
                        if ($i != (count($conversation['users_informations']) - 1)) {
                            $name_conversation .= ', ';
                        }
                    }
                }
            } else {
                foreach ($conversation['users_informations'] as $user_information) {
                    if ($user_information['id'] != $idUser) {
                        // Définit image de la conversation solo
                        $image_conversation = $user_information['picture_profil'];
                        // Définit nom de la conversation solo
                        $name_conversation = $user_information['first_name'] . ' ' . $user_information['last_name'];
                    }
                }
            }
            $allconversationsInformations[] = [
                'name' => strlen($name_conversation) > 30 ? substr($name_conversation, 0, 30) . '...' : $name_conversation,
                'fullname' => $name_conversation,
                'creator_id' => $conversation['creator_id'],
                'image' => $image_conversation,
                'last_message' => $conversation['message_content'],
                'conversation_id' => $conversation['conversation_id'],
                'members_number' => count($conversation['users_informations']),
                'members_informations' => $conversation['users_informations']
            ];
        }
        return $allconversationsInformations;
    }


}