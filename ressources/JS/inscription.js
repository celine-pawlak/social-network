$(document).ready(function(){
    $('#submit_ins').click(function(e){
        e.prenventDefault();

        $.post(
            'App/Controller/IndexController',
            {
                action : 'insertUser',
                mail : $('#email').val(),
                first_name : $('#first_name').val(),
                last_name : $('#last_name').val(),
                birthday : $('#birthday').val(),
                password : $('#password').val(),
                confirmation_password : $('#conf_')
            },
            function(date){

            }
        );
    });

    // retour page de connexion
    $('#page_connexion').click(function(){
        $.post(
            'App/Controller/IndexController',
            {
                action : 'index'
            },
            function(data){
                console.log(data);
                if(data == ''){
                    console.log('Failed');
                } else{
                    $('body').html(data);
                }
            }
        );
    });
});