$(function()
    {                          
        $('.react').click(function()
            {
                // let id_bloc = $(this).attr('id');
                let element = $(this).closest('div').attr('id');
                let id_bloc = element.split('_');      
                let id = id_bloc[1]               
                let bloc = id_bloc[0];                
                getMoji(id, bloc);
            })
        $(document).click(function()
            {                
                $('#react_bloc').remove();
            })
    });

    function getMoji(id_bloc, bloc)
        {            
            $.ajax(
                {
                    url : 'App/Controller/IndexController',
                    type : 'post',
                    data : {action : 'getEmoji'},
                    success : (data) =>
                        {                             
                            console.log(data)                           ;
                            let test = JSON.parse(data);                               
                            $('#'+bloc+'_'+id_bloc).append('<aside id="react_bloc"></aside>');                                                                          
                            $.map(test, function (a)
                                {                                                      
                                    let icon = '<i id="'+a.id+'" class="'+a.emoji+' emoji"></i>';                                       
                                    $('#react_bloc').append(icon);                                    
                                })
                            $('#react_bloc').on("click",function(e)
                                {
                                    let target_id = e.target;
                                    let id_react = $(target_id).attr('id');                                                                        
                                    insertMoji(id_react, id_bloc, bloc);
                                })
                        }
                });
        }
    function insertMoji(id_react, id_bloc, bloc)
        {
            $.ajax(
                {
                    url : 'App/Controller/IndexController',
                    type : 'post',
                    data : {action : 'insertEmoji', id_react : id_react, id_bloc : id_bloc, bloc : bloc},
                    success : (data) =>
                        {
                            console.log(data);
                        }
                });
        }