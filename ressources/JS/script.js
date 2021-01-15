function textAreaAdjust(element) {
    element.style.height = "1px";
    element.style.height = (25+element.scrollHeight)+"px";
}

$(function () {

    // Dropdown header
    $('.dropdown-trigger').dropdown();
    // Responsive menu
    $('.sidenav').sidenav({edge: 'left'});
    // Search bar header

    $.ajax(
        {
            url: 'App/Controller/IndexController',
            type: 'post',
            data: {action: 'search'},
            success: (response) => {
                var user = JSON.parse(response);
                var dataUser = {};
                var dataUserId = {};

                let idCreator = localStorage.id;
                let idMembre = '';
                for (var i = 0; i < user.length; i++) {
                    dataUser[user[i].first_name + ' ' + user[i].last_name] = 'ressources/img/' + user[i].picture_profil;
                    dataUserId[user[i].first_name + ' ' + user[i].last_name] = user[i];

                }
                // Autocomplete barre de recherche header

                $('input.autocomplete').autocomplete(
                    {
                        data: dataUser,
                        onAutocomplete: function (e) {
                            $('input.autocomplete').val('');
                            window.location = "profil?id=" + dataUserId[e].id;
                        },
                    });
                //Ajout membre conversation
                $('#new_member_id').autocomplete(
                    {
                        data: dataUser,
                        onAutocomplete: function (e) {
                            if (dataUserId[e].id === idCreator) {
                                $('#new_member_id').val('');
                            } else {
                                if (idMembre === '') {
                                    idMembre = dataUserId[e].id;
                                    $('#new_member_id').val('');
                                    $('#liste_membre').append('<li id=' + dataUserId[e].id + '>' + dataUserId[e].first_name + ' ' + dataUserId[e].last_name + ' <i class="fas fa-times"></i></li>');
                                    $('.fa-times').click(function () {
                                        $(this).parent().remove();
                                        idMembre = '';
                                    });
                                    // ici faire l'action
                                    // id de la personne à ajouter = idMembre
                                }
                            }
                        },
                    });
            },

        });
    // Bouton déco
    $('#deconnexion').click(function () {
        $.ajax(
            {
                url: 'App/Controller/IndexController',
                type: 'post',
                data: {action: 'deco'},
                success: (data) => {
                    localStorage.clear();
                    pageConnexion();
                    window.location = 'index.php';
                },
            });

    });
    //  Bouton créer conversation
    $('#bouton_conv').click(function (e) {
        $('body').append("<section id='pop-up-background' class='z-index-5 absolute flex flex-column justify-center align-center'>" +
            "<div id='pop-up-content' class='m-1 background-white p-05'>" +
            "<div class='row m-0' id='recherche_personne'>" +
            "<div class='col s12'>" +
            "<div class='row m-0'>" +
            "<div class='input-field col s12 m-0'>" +
            "<input type='text' id='autocomplete-conv' class='autocomplete' placeholder='Rechercher une personne...'/>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "<ul id='liste_personne'></ul>" +
            "<button id='creer_conv' class='bouton btn waves-effect waves-light col s6 offset-s3'>Créer<i class='material-icons right'>add_circle_outline</i></button>" +
            "</div>" +
            "</section>");

        $.ajax(
            {
                url: 'App/Controller/IndexController',
                type: 'post',
                data: {action: 'search'},
                success: (response) => {
                    var user = JSON.parse(response);
                    var dataUser = {};
                    var dataUserInfo = {};
                    var creatorId = localStorage.id;
                    var groupeId = [creatorId];
                    for (var i = 0; i < user.length; i++) {
                        dataUser[user[i].first_name + ' ' + user[i].last_name] = 'ressources/img/' + user[i].picture_profil;
                        dataUserInfo[user[i].first_name + ' ' + user[i].last_name] = user[i];
                    }
                    $('#autocomplete-conv').autocomplete(
                        {
                            data: dataUser,
                            onAutocomplete: function (e) {
                                if (jQuery.inArray(dataUserInfo[e].id, groupeId) !== -1) {
                                    $('#autocomplete-conv').val('');
                                } else {
                                    groupeId.push(dataUserInfo[e].id);
                                    $('#autocomplete-conv').val('');
                                    $('#liste_personne').append('<li class="collab" id=' + dataUserInfo[e].id + '>' + dataUserInfo[e].first_name + ' ' + dataUserInfo[e].last_name + ' <i class="fas fa-times"></i></li>');
                                    $('.fa-times').click(function () {
                                        $(this).parent().remove();
                                        groupeId.splice($.inArray(dataUserInfo[e].id, groupeId), 1);
                                    });
                                    $('#autocomplete-conv').focus();
                                    // Faire envoie ajax pour créer conversation
                                    // id du créateur = creatorId
                                    // tableau avec tous les id = groupeId
                                }
                            },
                        });
                    $('#creer_conv').click(function () {
                        $.post(
                            'App/Controller/MessagerieController',
                            {
                                action : 'newConversationBIS',
                                members_id : groupeId,
                            },
                            function(data){
                                $('#pop-up-background').remove();
                                localStorage.setItem('currentConversationId', JSON.parse(data));
                                getMessages(JSON.parse(data));
                                console.log(localStorage.getItem('currentConversationId'));
                            }
                        )
                    });
                },
            });

        //gestion disparition du bouton
        var modal = document.getElementById("pop-up-background");
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.remove();
            }
        };
    });
    // Bloquage de l'envoie du formulaire
    $(".form_profile").submit(function(e) 
        {
            e.preventDefault();
        });
    // Bouton ajout publication
    $('#add_post').click(function(e)
        {
            e.preventDefault();
            var content_post = $('#textarea_post').val();        
            $.ajax(
                {
                    url: 'App/Controller/IndexController',
                    type: 'post',
                    data: {post : content_post, action : 'jsAddPostFormWall'},
                    success: (data)=>
                        {
                            console.log(data);
                        }
                });
        });
});

