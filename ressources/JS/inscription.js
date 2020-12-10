$(document).ready(function(){
    // S'inscrire
    $('#submit_ins').click(function(e){
        e.preventDefault();

        $.post(
            'App/Controller/IndexController',
            {
                action : 'insertUser',
                mail : $('#email').val(),
                first_name : $('#first_name').val(),
                last_name : $('#last_name').val(),
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
                    console.log('Failed ajax');
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