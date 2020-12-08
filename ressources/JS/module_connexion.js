$(document).ready(function(){
    $('#inscription').click(function(){
        $('main').html('');
        $.post(
            'App/Controller/IndexController',
            {
                action : 'inscription'
            },
            function(data){
                if(data == 'Sucess'){
                    console.log('page inscription');
                } else{
                    console.log('Failed');
                }
            }
        )
    })
})