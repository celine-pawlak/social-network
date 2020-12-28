function getMessages() {
    $.ajax({
        url: "App/Controller/MessagerieController",
        method: 'post',
        dataType: 'json',
        data: {
            action: 'getMessages'
        },
        success: function (result) {
            console.log(result);
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

        var avatar_conv = new FormData(document.getElementById('messagerie'));
        avatar_conv.append('action', 'avatarConversation');

        $.ajax({
            url : "App/Contender/MessagerieController",
            method : "POST",
            data: {},
            Type : "json",
            success: function(){

            }
        })
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