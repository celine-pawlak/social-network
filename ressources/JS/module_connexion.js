$(document).ready(function(){
    $('#submit_co').click(function(e) {
        e.preventDefault();

        $.post(
            'App/Controller/IndexController.php',
            {
                action : 'seConnecter',
                mail : $('#email').val(),
                password : $('#password').val()
            },
            function(data){
                console.log(data);
                var user = JSON.parse(data);
                if(user[0] == 'connecté') {
                    localStorage.setItem()
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