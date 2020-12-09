$(document).ready(function(){
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