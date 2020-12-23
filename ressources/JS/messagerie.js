function getMessages() {
    let idConversation = $('#add_message').val();
    var idUser = localStorage.id;
    $.ajax({
        url: "App/Controller/MessagerieController",
        method: 'post',
        dataType: 'json',
        data: {
            action: 'getMessages',
            id_conversation: idConversation
        },
        success: function (result) {
            const htmlmessages = result.last_messages.map(function (message) {
                console.log(message.id);
                const htmladdreaction = result.smileys.map(function (smiley) {
                    return '<button class="clickable background-white no-border hover-blue-grey border-radius-50px m-02"\n' +
                        '  name="add_reaction_message"\n' +
                        '  value="' + message.id + '.' + smiley.id + '">\n' +
                        '  <i class="' + smiley.emoji + '"></i>\n' +
                        '</button>'
                }).join('');
                var emojisCount = [];
                message.reactions.map(function (reaction) {
                    var reactionEmoji = reaction.emoji;
                    if ((typeof emojisCount[reactionEmoji] !== 'undefined') && (emojisCount[reactionEmoji].length !== 0)) {
                        emojisCount[reaction.emoji].counting++;
                        emojisCount[reaction.emoji].phrase.push(reaction.first_name + ' ' + reaction.last_name + ' ' + reaction.type);
                        emojisCount[reaction.emoji].id = reaction.id;
                    } else {
                        emojisCount[reactionEmoji] = {
                            counting: 1,
                            phrase : [reaction.first_name + ' ' + reaction.last_name + ' ' + reaction.type],
                            id : reaction.id
                        };
                    }
                });
                console.log(emojisCount);
                emojisCount.map(function (test){
                    console.log(test);
                });
                // const htmlseereaction = '<button class="box-shadow background-yellow p-025 border-radius-30 no-border clickable relative hover-parent"\n' +
                //         'name="add_reaction_message"\n' +
                //         'value="' + message.id + '.' + smiley.id + '<?= $emoji[\'id\'] ?>">\n' +
                //         '  <div class="absolute position-top-outside hover-child m-0 <?= ($message[\'users_id\'] == $idUser) ? \'position-left\' : \'position-right\' ?>">\n' +
                //         '    <p class="w-max-content font-smile-small background-white <?= ($message[\'users_id\'] == $idUser) ? \'likes_left\' : \'likes_right\' ?>">\n' +
                //         '    <?php foreach ($emoji[\'phrase\'] as $phrase): ?>\n' +
                //         '      <span><?= $phrase ?></span><br>\n' +
                //         '      <?php endforeach; ?>\n' +
                //         '    </p>\n' +
                //         '  </div>\n' +
                //         '  <i class="<?= $emoji_key ?>"></i> <?= $emoji[\'count\'] ?>\n' +
                //         '</button>';


                return '<span class="light-grey-text mx-1 ' + (message.users_id == idUser ? 'self-align-flexend' : '') + '"> ' + message.creation_date + ' </span>\n' +
                    '  <div class="hover-parent relative card border-radius-50px ' + (message.users_id == idUser ? 'background-blue-grey flex-row-reverse' : 'background-white flex-row') + '" id="messages_' + message.id + '">\n' +
                    '    <i class="fas fa-smile"></i><span>+</span>\n' +
                    '    <div class="absolute position-top hover-child m-0 ' + (message.users_id == idUser ? 'position-left-up ml-05' : 'position-right-up mr-05') + '">\n' +
                    '      <section class="background-white border-radius-10 grid column-2 p-025 box-shadow z-index-3">\n' +
                    '      ' + htmladdreaction + ' \n' +
                    '      </section>\n' +
                    '    </div>' +
                    '  </div>';
            }).join('');

            $('#all_messages').html(htmlmessages);


            // return '<span class="light-grey-text mx-1 ' + (message.users_id == idUser ? 'self-align-flexend' : '') + '">' + message.creation_date + '</span>\n' +
            //     '                            <div class="hover-parent relative card border-radius-50px ' + (message.users_id == idUser ? 'background-blue-grey flex-row-reverse' : 'background-white flex-row') + '"\n' +
            //     '                                 id="messages_' + message.id + '">\n' +
            //     '                                <!-- Ajouter une réaction -->\n' +
            //     '                                <div class="hover-child absolute ' + (message.users_id == idUser ? 'position-left-up ml-05' : 'position-right-up mr-05') + '">\n' +
            //     '                                    <div class="m-0 box-shadow background-white grey-text p-025 border-radius-30 no-border clickable relative hover-parent">\n' +
            //     '                                        <i class="fas fa-smile"></i><span>+</span>\n' +
            //     '                                        <div class="absolute position-top hover-child m-0 ' + (message.users_id == idUser ? 'position-right-outside pl-05' : 'position-left-outside pr-05') + '">\n' +
            //     '                                            <section class="background-white border-radius-10 grid column-2 p-025 box-shadow z-index-3">\n' +
            //     '+ message.smileys.map(function (smiley) { +' +
            //     '                                                    <button class="clickable background-white no-border hover-blue-grey border-radius-50px m-02"\n' +
            //     '                                                            name="add_reaction_message"\n' +
            //     '                                                            value="'`${message.id}.${smiley.id}` + '">\n' +
            //     '                                                        <i class="'`${smiley.emoji}` + '"></i>\n' +
            //     '                                                    </button>\n' +
            //     '+ }); +' +
            //     '                                            </section>\n' +
            //     '                                        </div>\n' +
            //     '                                    </div>\n' +
            //     '                                </div>\n' +
            //     '                                <!-- Voir les réactions -->\n' +
            //     '                                <div class="absolute ' + (message.users_id == idUser ? 'position-left-down ml-05' : 'position-right-down mr-05') + '">\n' +
            //     '+ if(Array.isArray(message.reactions) && message.reactions.length) +' +
            //     // '                                    <?php if (!empty($message[\'reactions\'])): ?>\n' +
            //     '+ message.reactions.map(function (reaction) { +' +
            //     // '                                        <?php foreach ($message[\'reactions\'] as $reaction): ?>\n' +
            //     '+ if ((Array.isArray(emojisCount)) && (reaction.emoji in emojisCount)) +' +
            //     '+ emojisCount[reaction.emoji][\'count\']++; +' +
            //     '+ emojisCount[reaction.emoji][\'phrase\'][] = '`${reaction.first_name} ${reaction.last_name} ${reaction.type}` + ';\n' +
            //     '+ emojisCount[reaction.emoji][\'id\'] = '`${reaction.id}` + ';\n' +
            //     '                                            } else {\n' +
            //     '+  var emojisCount[reaction.emoji][\'count\'] = 1; +' +
            //     '+  emojisCount[reaction.emoji][\'phrase\'][] = '`${reaction.first_name} ${reaction.last_name} ${reaction.type}` + ';\n' +
            //     '+  emojisCount[reaction.emoji][\'id\'] = '`${reaction.id}` + ';\n' +
            //     '                                            } ?>\n' +
            //     '+ }); +' +
            //     '                                        <?php foreach ($emojis_count as $emoji_key => $emoji): ?>\n' +
            //     '                                            <button class="box-shadow background-yellow p-025 border-radius-30 no-border clickable relative hover-parent"\n' +
            //     '                                                    name="add_reaction_message"\n' +
            //     '                                                    value="<?= $message[\'id\'] ?>.<?= $emoji[\'id\'] ?>">\n' +
            //     '                                                <div class="absolute position-top-outside hover-child m-0 <?= ($message[\'users_id\'] == $idUser) ? \'position-left\' : \'position-right\' ?>">\n' +
            //     '                                                    <p class="w-max-content font-smile-small background-white <?= ($message[\'users_id\'] == $idUser) ? \'likes_left\' : \'likes_right\' ?>">\n' +
            //     '                                                        <?php foreach ($emoji[\'phrase\'] as $phrase): ?>\n' +
            //     '                                                            <span><?= $phrase ?></span><br>\n' +
            //     '                                                        <?php endforeach; ?>\n' +
            //     '                                                    </p>\n' +
            //     '                                                </div>\n' +
            //     '                                                <i class="<?= $emoji_key ?>"></i> <?= $emoji[\'count\'] ?>\n' +
            //     '                                            </button>\n' +
            //     '                                        <?php endforeach; ?>\n' +
            //     '                                    <?php endif; ?>\n' +
            //     '                                </div>\n' +
            //     '                                <!-- user name and picture -->\n' +
            //     '                                <img class="border-radius-100 m-05"\n' +
            //     '                                     src="ressources/img/<?= $message[\'picture_profil\'] ?>"\n' +
            //     '                                     alt="Image profil de <?= $message[\'first_name\'] ?> <?= $message[\'last_name\'] ?>"\n' +
            //     '                                     width="50px"\n' +
            //     '                                     height="50px">\n' +
            //     '                                <div class="flex-column m-05 <?= ($message[\'users_id\'] == $idUser) ? \'align-items-flexend\' : \'\' ?>">\n' +
            //     '                                    <span class="bold-text"><?= $message[\'first_name\'] ?> <?= $message[\'last_name\'] ?></span>\n' +
            //     '                                    <span class="<?= ($message[\'users_id\'] == $idUser) ? \'pl-1\' : \'pr-1\' ?>"><?= $message[\'content\'] ?></span>\n' +
            //     '                                </div>\n' +
            //     '                            </div>\n' +
            //     '                            <?php $emojis_count = []; ?>'
            // })

            // console.log(htmlmessages);

            // const html = result.reverse().map(function (message) {
            //     return '<div class="messages">\n' +
            //         '        <span class="date">' + message.created_at.substring(11, 16) + '</span>\n' +
            //         '        <span class="author">' + message.id_user + '</span>\n' +
            //         '        <span class="content">' + message.content + '</span>\n' +
            //         '    </div>';
            // }).join('');
            // $('.messages').html(html);
            // $('.messages').scrollTop = $('.messages').scrollHeight;
        }
    });
}

function postMessage() {

    var idConversation = $('#add_message').val();
    var content = $('#new_message_content').val();
    var idUser = localStorage.id;
    $.ajax({
        url: "App/Controller/MessagerieController",
        method: 'post',
        data: {
            action: 'postMessage',
            id_user: idUser,
            id_conversation: idConversation,
            content: content
        },
        dataType: 'json',
        success: function (result) {
            $('#new_message_content').val('').focus();
            getMessages();
        }
    });
}

$(function () {
    localStorage.setItem("id", 3);
    $('form').submit(function (event) {
        event.preventDefault();
    })

    getMessages();

    // Scroll bar down
    $('#all_messages').scrollTop($(this).height());

    // Nouveau message
    $('#new_message_content').focus().keypress(function (e) {
        if (e.keyCode == 13) {
            postMessage();
        }
    })

    // Smiley

    // Edit name conversation

    // Edit image conversation ???

    // Ajout personne au groupe

    // Nouvelle conversation


    // + 20 messages si scroll top
});