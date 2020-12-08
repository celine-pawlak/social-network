<div class="max-width-content">
    <button id="create_conversation" class="ml-3 button-inherit"><i class="fas fa-plus-circle yellow-text"></i> Créer
        une conversation
    </button>
    <div class="flex-row justify-content-spacearound">
        <form id="all_conversations" class="overflow-scroll-y grey lighten-4 card border-radius-70px p-2 m-1 h-70vh"
              method="post">
            <?php if ($allconversationsInformations == null): ?>
                <p>Vous n'avez pas de conversation</p>
            <?php else : ?>
                <?php foreach ($allconversationsInformations as $conversationInformations) : ?>
                    <article class="flex-row align-items-center py-05 border-bot-blue w-200px">
                        <img class="border-radius-100 mx-auto w-30 m-05"
                             src="ressources/img/<?= $conversationInformations['image'] ?>">
                        <div class="flex-column">
                            <span class="bold-text"><?= $conversationInformations['name'] ?></span>
                            <span class="light-grey-text"><?= $conversationInformations['last_message'] ?></span>
                        </div>
                    </article>
                    <button name="seeConversation" value="<?= $conversationInformations['conversation_id'] ?>"></button>
                <?php endforeach; ?>
            <?php endif; ?>
        </form>
        <section id="current_conversation"
                 class="grey lighten-4 card border-radius-70px flex-1 m-1 p-2 h-70vh">
            <div class="flex-column justify-content-spacebetween h-100">
                <div class="messages flex-column overflow-scroll-y">
                    <?php foreach ($last_messages as $message): ?>
                        <span class="light-grey-text mx-1 <?= ($message['users_id'] == $idUser) ? 'self-align-flexend' : '' ?>"><?= $message['creation_date'] ?></span>
                        <div class="card border-radius-50px <?= ($message['users_id'] == $idUser) ? 'background-blue-grey flex-row-reverse' : 'background-white flex-row' ?>"
                             id="messages_<?= $message['id'] ?>">
                            <img class="border-radius-100 m-05" src="ressources/img/<?= $message['picture_profil'] ?>"
                                 width="50px">
                            <div class="flex-column m-05 <?= ($message['users_id'] == $idUser) ? 'align-items-flexend' : '' ?>">
                                <span class="bold-text"><?= $message['first_name'] ?> <?= $message['last_name'] ?></span>
                                <span><?= $message['content'] ?></span>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <span class="px-1 flex-row justify-content-spacebetween align-items-center background-white border-radius-70px card"><input
                            class="input-inherit my-05" placeholder="Votre réponse..."> <i
                            class="fas fa-paper-plane blue-text m-05"></i></span>
            </div>
        </section>
    </div>
</div>