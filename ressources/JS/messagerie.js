function doesReactionExist(emojis, reactionEmoji, reaction) {
    let test = false;
    emojis.map(function (react) {
        if ((typeof react[reactionEmoji] !== 'undefined') && (react[reactionEmoji].length !== 0)) {
            react[reactionEmoji].counting++;
            react[reactionEmoji].phrase.push(reaction.first_name + ' ' + reaction.last_name + ' ' + reaction.type);
            react[reactionEmoji].id = reaction.id;
            test = true;
        }
    });
    return test;
}

function getAllConversationsLastInformations(conversationsInformations) {
    console.log(conversationsInformations);

}

function getMessages(conversationId) {

    var idUser = localStorage.id;
    $.ajax({
        url: "App/Controller/MessagerieController",
        method: 'post',
        dataType: 'json',
        data: {
            action: 'getMessages',
            id_conversation: conversationId
        },
        success: function (result) {
            $('#add_message').val(conversationId);
            result.allconversationsInformations.map(function (conversationInformation) {
                if (conversationInformation.conversation_id == conversationId) {
                    currentConversation = conversationInformation;
                }
            })
            $('#conversation_image').attr('src', 'ressources/img/' + currentConversation.image + '');
            $('#new_conversation_name').val(currentConversation.fullname);
            if ((currentConversation.members_number > 2) && (currentConversation.creator_id == idUser)) {
                $('#new_conversation_name').prop("disabled", false);
                $('#label_new_conversation').removeClass('d-none');
                $('#update_conversation_name').removeClass('d-none');
                $('#members_list').removeClass('d-none').html(currentConversation.members_informations.map(function (user_information){
                    return '<li class="hover-blue-grey p-025 border-radius-50px">\n' +
                        '  <a class="flex-row align-items-center black-text" href="profil?id='+ user_information.id +'">\n' +
                        '    <img class="border-radius-100 mr-05 background-white"\n' +
                        '         src="ressources/img/'+ user_information.picture_profil +'"\n' +
                        '         alt="Image de profil de '+ user_information.first_name +' '+ user_information.last_name +'"\n' +
                        '         width="20px"\n' +
                        '         height="20px">\n' +
                        '    <span class="font-smile-small">'+ user_information.first_name +' '+ user_information.last_name +'</span>\n' +
                        '  </a>\n' +
                        '</li>'}).join(''));
                $('#members_informations').html(' ' + currentConversation.members_number);
            } else {
                $('#new_conversation_name').prop("disabled", true);
                $('#label_new_conversation').addClass('d-none');
                $('#update_conversation_name').addClass('d-none');
                $('#members_list').addClass('d-none');
                $('#members_informations').html('+');

            }
            $('#update_conversation_name').val(currentConversation.conversation_id);


            const htmlmessages = result.last_messages.map(function (message) {
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

                    if (doesReactionExist(emojisCount, reactionEmoji, reaction)) {
                    } else {
                        emojisCount.push(
                            {
                                [reactionEmoji]: {
                                    counting: 1,
                                    phrase: [reaction.first_name + ' ' + reaction.last_name + ' ' + reaction.type],
                                    id: reaction.id
                                }
                            });
                    }
                });

                emojisCount.map(function (emoji) {

                });

                var htmlseeReaction = emojisCount.map(function (emoji) {

                    var htmlPhrases = Object.values(emoji)[0].phrase.map(function (phrase) {
                        return '<span> ' + phrase + ' </span><br>'
                    }).join('');

                    for (var property in emoji) {
                        var emojiClassName = property;
                    }

                    return '<button class="box-shadow background-yellow p-025 border-radius-30 no-border clickable relative hover-parent m-01"\n' +
                        'name="add_reaction_message"\n' +
                        'value="' + message.id + '.' + Object.values(emoji)[0].id + '">\n' +
                        '  <div class="absolute position-top-outside hover-child m-0 ' + (message.users_id == idUser ? 'position-left' : 'position-right') + '">\n' +
                        '    <p class="w-max-content font-smile-small background-white ' + (message.users_id == idUser ? 'likes_left' : 'likes_right') + '">\n' +
                        '    ' + htmlPhrases + ' \n' +
                        '    </p>\n' +
                        '  </div>\n' +
                        '  <i class="' + emojiClassName + '"></i> ' +
                        '  <span> ' + Object.values(emoji)[0].counting + '</span>\n' +
                        '</button>'
                }).join('');

                return '  <span class="light-grey-text mx-1 ' + (message.users_id == idUser ? 'self-align-flexend' : '') + '"> ' + message.creation_date + ' </span>\n' +
                    '  <div class="hover-parent relative card border-radius-50px ' + (message.users_id == idUser ? 'background-blue-grey flex-row-reverse' : 'background-white flex-row') + '" id="messages_' + message.id + '">\n' +
                    '    <div class="hover-child absolute ' + (message.users_id == idUser ? 'position-left-up ml-05' : 'position-right-up mr-05') + '">\n' +
                    '      <div class="m-0 box-shadow background-white grey-text p-025 border-radius-30 no-border clickable relative hover-parent">\n' +
                    '        <i class="fas fa-smile"></i><span>+</span>\n' +
                    '        <div class="absolute position-top hover-child m-0 ' + (message.users_id == idUser ? 'position-right-outside pl-05' : 'position-left-outside pr-05') + '">\n' +
                    '          <section class="background-white border-radius-10 grid column-2 p-025 box-shadow z-index-3">\n' +
                    '          ' + htmladdreaction + '\n' +
                    '          </section>\n' +
                    '        </div>\n' +
                    '      </div>\n' +
                    '    </div>\n' +
                    '  <div class="absolute ' + (message.users_id == idUser ? 'position-left-down ml-05' : 'position-right-down mr-05') + '">\n' +
                    '   ' + htmlseeReaction + '\n' +
                    '  </div>\n' +
                    '  <img class="border-radius-100 m-05"\n' +
                    '  src="ressources/img/' + message.picture_profil + '"\n' +
                    '  alt="Image profil de ' + message.first_name + ' ' + message.last_name + '"\n' +
                    '  width="50px"\n' +
                    '  height="50px">\n' +
                    '  <div class="flex-column m-05 ' + (message.users_id == idUser ? 'align-items-flexend' : '') + '">\n' +
                    '    <span class="bold-text">' + message.first_name + ' ' + message.last_name + '</span>\n' +
                    '    <span class="' + (message.users_id == idUser ? 'pl-1' : 'pr-1') + '">' + message.content + '</span>\n' +
                    '  </div>\n' +
                    '</div>'
            }).join('');

            $('#all_messages').html(htmlmessages);
            // Scroll bar down
            $("#all_messages").scrollTop($("#all_messages")[0].scrollHeight);
            getAllConversationsLastInformations(result.allconversationsInformations)
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
            getMessages(idConversation);
        }
    });
}

$(function () {
    localStorage.setItem("id", 3);

    var currentConversationId = $('#add_message').val();
    getMessages(currentConversationId);

    //Changer conversation
    $('#all_conversations').on('click', 'article', function (event) {
        let conversationId = $(this).children('button')[0].id;
        currentConversationId = conversationId.slice(17);
        getMessages(currentConversationId);
    })


    $('#add_message').click(postMessage);

    // Nouveau message
    $('#new_message_content').focus().keypress(function (e) {
        if (e.keyCode == 13) {
            postMessage();
        }
    })

    // update de l'image de conversation
    $('#modal_avatar').hide();
    $('#img_conv').click(function(){
        $('#modal_avatar').show();
    });

    $('#validation_avatar_conv').click(function(e){
        e.preventDefault();

        var img_conv = new FormData(document.getElementById('form_avatar_conv'));
        img_conv.append('action', 'updateImgConversation');
        $.ajax({
            url :'App/Controller/MessagerieController',
            type: "POST",
            data : img_conv,
            success : function(data){
                var img_conv_avatar = $('<img id="img_conv_modal" src="">');
                img_conv_avatar.append($('#modal_avatar'));

                if($("#img_conv_modal").val() != "") {
                    var changer_avatar = $("#img_conv_modal")[0].files[0].name;

                    if(changer_avatar != "") {
                        $("#image_avatar").attr("src", "ressources/img/" + changer_avatar);
                        $('#pp_header').attr("src", "ressources/img/" + changer_avatar);
                      }
                }
            }
        })
    });

    // Smiley

    // Edit name conversation

    // Edit image conversation ???

    // Ajout personne au groupe

    // Nouvelle conversation

    // + 20 messages si scroll top
})