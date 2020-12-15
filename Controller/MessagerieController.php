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
        $idUser = 3;  // A MODIFIER QUAND SESSION DEFINIE

        $allconversationsInformations = null;
        $last_messages = null;
        $conversations = new Conversation;
        $reacts = new Reaction;

        $allconversations = $conversations->allConversationsWithLastMessageSent($idUser);
        foreach ($allconversations as $key => $conversation) {
            $allconversations[$key]['users_informations'] = $conversations->usersFromConversationInformations($conversation['conversation_id']);
        }
        $allconversationsInformations = $this->getConversationsInformations($allconversations, $idUser);

        if ($allconversationsInformations != null){
            $id_conversation = $allconversations[0]['conversation_id'];
            if (isset($_POST['seeConversation']) && !empty($_POST['seeConversation'])){
                $id_conversation = $_POST['seeConversation'];
            }
            $messages = new Message;
            $last_messages = $messages->getAllMessagesFromConversation($id_conversation);

            foreach ($last_messages as $key => $message){
                $last_messages[$key]['reactions'] = $reacts->getAllReactionsFromMessage($message['id']);
            }
        }

        $smileys = $reacts->getEmoji();

        $this->render('messagerie.messagerie', compact('allconversationsInformations', 'last_messages', 'idUser', 'id_conversation', 'smileys'));
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
                'creator_id' => $conversation['creator_id'],
                'image' => $image_conversation,
                'last_message' => $conversation['message_content'],
                'conversation_id' => $conversation['conversation_id'],
            ];
        }
        return $allconversationsInformations;
    }


}