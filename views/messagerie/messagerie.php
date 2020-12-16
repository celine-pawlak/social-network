<form id="messagerie" class="max-width-content" method="POST">
    <!-- Création conversation -->
    <div id="create_conversation">
        <button id="bouton_conv" class="ml-3 button-inherit"><i class="fas fa-plus-circle yellow-text"></i> Créer
            une conversation
        </button>
    </div>
    <div class="flex-row justify-content-spacearound">
        <!-- Liste conversations en cours -->
        <section id="all_conversations"
                 class="overflow-scroll-y scrollbar-conversations grey lighten-4 card border-radius-70px py-2 px-1 m-1 h-70vh">
            <?php if ($allconversationsInformations == null): ?>
                <p>Vous n'avez pas de conversation</p>
            <?php else : ?>
                <?php foreach ($allconversationsInformations as $conversationInformations) : ?>
                    <?php if ($conversationInformations['conversation_id'] == $id_conversation) {
                        $current_conversation = $conversationInformations;
                    } ?>
                    <article class="flex-row align-items-center py-05 border-bot-blue w-230px relative">
                        <button id="allconversations_<?= $conversationInformations['conversation_id'] ?>"
                                class="absolute position-all w-100 no-border no-background no-background-focus clickable"
                                name="seeConversation"
                                value="<?= $conversationInformations['conversation_id'] ?>"></button>
                        <img class="border-radius-100 mx-auto m-05 background-white"
                             src="ressources/img/<?= $conversationInformations['image'] ?>"
                             alt="Image de la conversation"
                             width="50px"
                             height="50px">
                        <div class="flex-column">
                            <span class="bold-text"><?= $conversationInformations['name'] ?></span>
                            <span class="light-grey-text"><?= $conversationInformations['last_message'] ?></span>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
        <!-- Conversation active -->
        <section class="grey lighten-4 card border-radius-70px flex-1 m-1 p-2 h-70vh">
            <?php if ($last_messages == null): ?>
            <!-- Si pas de conversation -->
            <div class="flex-column justify-content-center align-items-center h-100">
                <img width="100px" src="ressources/img/default_conversation_image.png" alt="Logo de la Plateforme_">
                <?php else : ?>
                <!-- Si conversation existante -->
                <div class="flex-row align-items-center">
                    <img class="border-radius-100 mx-auto m-05 background-white"
                         src="ressources/img/<?= $current_conversation['image'] ?>"
                         alt="Image de la conversation"
                         width="50px"
                         height="50px">
                    <div class="input-field flex-1">
                        <input type="text" name="current_conversation_name" id="current_conversation_name" value="<?= $current_conversation['fullname'] ?>" <?= ($current_conversation['creator_id'] == $idUser) ? '' : 'disabled' ?>>
                        <label for="current_conversation_name">Nom de la conversation</label>
                        <i class="material-icons tiny">edit</i>
                    </div>
                </div>
                <div class="flex-column justify-content-spacebetween h-100">
                    <div class="messages flex-column overflow-scroll-y scrollbar-conversation h-100">
                        <!-- Messages -->
                        <?php foreach ($last_messages as $message): ?>
                            <span class="light-grey-text mx-1 <?= ($message['users_id'] == $idUser) ? 'self-align-flexend' : '' ?>"><?= strftime('%d/%m/%Y %R', strtotime($message['creation_date'])) ?></span>
                            <div class="hover-parent relative card border-radius-50px <?= ($message['users_id'] == $idUser) ? 'background-blue-grey flex-row-reverse' : 'background-white flex-row' ?>"
                                 id="messages_<?= $message['id'] ?>">
                                <!-- Ajouter une réaction -->
                                <div class="hover-child absolute <?= ($message['users_id'] == $idUser) ? 'position-left-up ml-05' : 'position-right-up mr-05' ?>">
                                    <div class="m-0 box-shadow background-white grey-text p-025 border-radius-30 no-border clickable relative hover-parent">
                                        <i class="fas fa-smile"></i><span>+</span>
                                        <div class="absolute position-top hover-child m-0 <?= ($message['users_id'] == $idUser) ? 'position-right-outside pl-05' : 'position-left-outside pr-05' ?>">
                                            <section
                                                    class="background-white border-radius-10 grid column-2 p-025 box-shadow z-index-3">
                                                <?php foreach ($smileys as $smiley): ?>
                                                    <button class="clickable background-white no-border hover-blue-grey border-radius-50px m-02"
                                                            name="add_reaction_message"
                                                            value="<?= $message['id'] ?>.<?= $smiley['id'] ?>">
                                                        <i class="<?= $smiley['emoji'] ?>"></i>
                                                    </button>
                                                <?php endforeach; ?>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                                <!-- Voir les réactions -->
                                <div class="absolute <?= ($message['users_id'] == $idUser) ? 'position-left-down ml-05' : 'position-right-down mr-05' ?>">
                                    <?php if (!empty($message['reactions'])): ?>
                                        <?php foreach ($message['reactions'] as $reaction): ?>
                                            <?php if (isset($emojis_count) && array_key_exists($reaction['emoji'], $emojis_count)) {
                                                $emojis_count[$reaction['emoji']]['count']++;
                                                $emojis_count[$reaction['emoji']]['phrase'][] = $reaction['first_name'] . ' ' . $reaction['last_name'] . ' ' . $reaction['type'];
                                                $emojis_count[$reaction['emoji']]['id'] = $reaction['id'];
                                            } else {
                                                $emojis_count[$reaction['emoji']]['count'] = 1;
                                                $emojis_count[$reaction['emoji']]['phrase'][] = $reaction['first_name'] . ' ' . $reaction['last_name'] . ' ' . $reaction['type'];
                                                $emojis_count[$reaction['emoji']]['id'] = $reaction['id'];
                                            } ?>
                                        <?php endforeach; ?>
                                        <?php foreach ($emojis_count as $emoji_key => $emoji): ?>
                                            <button class="box-shadow background-yellow p-025 border-radius-30 no-border clickable relative hover-parent"
                                                    name="add_reaction_message"
                                                    value="<?= $message['id'] ?>.<?= $emoji['id'] ?>">
                                                <div class="absolute position-top-outside hover-child m-0 <?= ($message['users_id'] == $idUser) ? 'position-left' : 'position-right' ?>">
                                                    <p class="w-max-content font-smile-small background-white <?= ($message['users_id'] == $idUser) ? 'likes_left' : 'likes_right' ?>">
                                                        <?php foreach ($emoji['phrase'] as $phrase): ?>
                                                            <span><?= $phrase ?></span><br>
                                                        <?php endforeach; ?>
                                                    </p>
                                                </div>
                                                <i class="<?= $emoji_key ?>"></i> <?= $emoji['count'] ?>
                                            </button>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <!-- user name and picture -->
                                <img class="border-radius-100 m-05"
                                     src="ressources/img/<?= $message['picture_profil'] ?>"
                                     alt="Image profil de <?= $message['first_name'] ?> <?= $message['last_name'] ?>"
                                     width="50px"
                                     height="50px">
                                <div class="flex-column m-05 <?= ($message['users_id'] == $idUser) ? 'align-items-flexend' : '' ?>">
                                    <span class="bold-text"><?= $message['first_name'] ?> <?= $message['last_name'] ?></span>
                                    <span class="<?= ($message['users_id'] == $idUser) ? 'pl-1' : 'pr-1' ?>"><?= $message['content'] ?></span>
                                </div>
                            </div>
                            <?php $emojis_count = []; ?>
                        <?php endforeach ?>
                    </div>
                    <!-- Envoyer un message -->
                    <span class="px-1 flex-row justify-content-spacebetween align-items-center background-white border-radius-70px card">
                        <label for="new_message_content" class="flex-1">
                            <input id="new_message_content" name="new_message_content" class="input-inherit my-05"
                                   placeholder="Votre message...">
                        </label>
                        <button id="add_message" name="add_message"
                                class="no-border background-white clickable no-background-focus"
                                value="<?= $id_conversation ?>"><i
                                    class="fas fa-paper-plane blue-text m-05"></i></button>
                    </span>
                    <?php endif ?>
                </div>
        </section>
    </div>
</form>