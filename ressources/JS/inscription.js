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
        // Vérifie que les mots de passe correspondent
        $('#conf_password').keyup(function () {
            isTheSame(this, $('#password'), 'nope', 'yep');
        });
    });


    // S'inscrire
    $('#submit_ins').click(function(e){
        e.preventDefault();

        $.post(
            'App/Controller/IndexController',
            {
                action : 'insertUser',
                mail : $('#email').val(),
                last_name : $('#last_name').val(),
                first_name : $('#first_name').val(),
                birthday : $('#birthday').val(),
                password : $('#password').val(),
                confirmation_password : $('#conf_password').val()
            },
            function(data){
                console.log(data);
                if(data == 'Success') {
                    console.log('success');
                    pageConnexion();
                } else {
                    $('.erreurs').removeClass('d-none');
                    $('.erreurs').html('<p class="write_error"></p>');
                    $('.write_error').append(data);
                }
            }
        );
    });

    // retour page de connexion
    $('#page_connexion').click(pageConnexion);
});

function pageConnexion(){
    $.post(
        'App/Controller/IndexController',
        {
            action : 'index'
        },
        function(data){
            if(data == ''){
                console.log('Failed');
            } else{
                $('body').html(data);
            }
        }
    );
}