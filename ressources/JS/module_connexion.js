$(document).ready(function(){
    $(function () {
        // Vérifie que le mail soit au format prenom.nom@laplateforme.io
        $('#email').keyup(function () {
            regexMailValide(this, 'nope', 'yep');
        });
        // Vérifie la sécurité du mot de passe
        $('#password').keyup(function () {
            regexPasswordValide(this, 'nope', 'yep');
        });
    });

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
                console.log(data);
                var user = JSON.parse(data);
                console.log(user);
                if(user[0] == 'connecté') {
                    console.log('cest good jonny');

                    localStorage.setItem('id', user[1]['id']);
                    localStorage.setItem('mail', user[1]['mail']);
                    localStorage.setItem('last_name', user[1]['last_name']);
                    localStorage.setItem('first_name', user[1]['first_name']);
                    localStorage.setItem('picture_profil', user[1]['picture_profil']);
                    localStorage.setItem('picture_cover', user[1]['picture_cover']);
                    localStorage.setItem('date_birth', user[1]['date_birth']);

                    // changement de view "fil d'actualité"
                } else {
                    console.log('erreur lors de la connexion');
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
})