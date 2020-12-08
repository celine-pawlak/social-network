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
        //Récupérer la dernière conversation en cours

        $this->render('messagerie.messagerie', compact('allconversations'));
    }


}