$(document).ready(function(){
        // Vérifie que le mail soit au format prenom.nom@laplateforme.io
        $('#email').keyup(function () {
            regexMailValide(this, 'nope', 'yep');
        });
        // Vérifie la sécurité du mot de passe
        $('#password').keyup(function () {
            regexPasswordValide(this, 'nope', 'yep');
        });
        // Verifie que les mdp sont identiques
        $('#conf_password').keyup(function(){
            var mdp = $('#password').val();
            isTheSame(this, mdp, 'nope', 'yep');
        });

        // verif reset
        $('#reset_password').keyup(function () {
            regexPasswordValide(this, 'nope', 'yep');
        });

        $('#conf_reset_password').keyup(function(){
            var conf_reset = $('#conf_reset_password');
            var mdp_reset = $('#reset_password');

            isTheSame(conf_reset, mdp_reset, 'nope', 'yep');
        });

    $('#oublier').click(function(e){
        e.preventDefault();

        $.post(
            'App/Controller/IndexController',
            {action : 'forgotPassword'},
            function(data){
                if(data != ''){
                    $('body').html(data);
                }
            }
        )
    })

    $('#submit_co').click(function(e) {
        e.preventDefault();

        $.post(
            'App/Controller/IndexController',
            {
                action : 'seConnecter',
                mail : $('#email').val(),
                password : $('#password').val()
            },
            function(data){
                var user = JSON.parse(data);
                if(user[0] == 'connecté') {
                    localStorage.setItem('id', user[1]['id']);
                    localStorage.setItem('mail', user[1]['mail']);
                    localStorage.setItem('last_name', user[1]['last_name']);
                    localStorage.setItem('first_name', user[1]['first_name']);
                    localStorage.setItem('picture_profil', user[1]['picture_profil']);
                    localStorage.setItem('picture_cover', user[1]['picture_cover']);
                    localStorage.setItem('date_birth', user[1]['date_birth']);

                    pageConnexion();
                } else {
                    $('.erreurs').removeClass('d-none');
                    $('.erreurs').html('<p class="write_error"></p>');
                    $('.write_error').append(data);
                }
            }
        );
    });

    $('#page_inscription').click(function(){
        $.post(
            'App/Controller/IndexController',
            {
                action : 'inscription'
            },
            function(data){

                if(data == ''){
                    console.log('Failed');
                } else{
                    $('body').html(data);
                }
            }
        );
    });

    $('#submit_reset').click(function(e){
        e.preventDefault();

        $.post(
            'App/Controller/IndexController',
            {
                action : 'resetPassword',
                mail : $('#email').val(),
                reset_password : $('#reset_password').val(),
                conf_reset_password : $('#conf_reset_password').val(),
            },
            function(data){
                console.log(data);
                if(data == 'Success'){
                    pageConnexion();
                } else {
                    console.log(data);
                }
            }
        )
    })
})