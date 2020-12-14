$(document).ready(function(){
    $('#modif_profil').click(function(){
        $.post(
            'App/Controller/ProfilController',
            {
                action : 'setProfil'
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