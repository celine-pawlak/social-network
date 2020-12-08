<?php

namespace App\Controller;

use App\Database\Conversation;

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
        $conversations = new Conversation;
        // Récupérations de toutes les conversations de l'utilisateur
        $allconversations = $conversations->allConversationsWithLastMessageSent($idUser);
        // Assigne à chaque conversation les infos nécessaires des utilisateurs participants
        foreach ($allconversations as $key => $conversation) {
            $allconversations[$key]['users_informations'] = $conversations->usersFromConversationInformations($conversation['conversation_id']);
        }
        // TRI DES INFORMATIONS DE CONVERSATIONS A AFFICHER
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
                    for ($i = 0; $i < count($conversation['users_informations']); $i++){
                        $name_conversation .= $conversation['users_informations'][$i]['first_name'] . ' ' . $conversation['users_informations'][$i]['last_name'];
                        if ($i != (count($conversation['users_informations']) - 1)){
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
                'name' => strlen($name_conversation) > 30 ? substr($name_conversation, 0, 30).'...' : $name_conversation,
                'creator_id' => $conversation['creator_id'],
                'image' => $image_conversation,
                'last_message' => $conversation['message_content']
            ];
        }

        //Récupérer la dernière conversation en cours

        $this->render('messagerie.messagerie', compact('allconversationsInformations'));
    }


}