$(document).ready(function(){
    $('#inscription').click(function(){
        $('main').html('');
        $.post(
            '../PHP/changement_index.php',
            {
                url : 'inscription'
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