$(function()
    {          
        //Au click sur le bouton d'ajout des réactions
        $('.react').click(function()
            {                
                // let id_bloc = $(this).attr('id');
                let element = $(this).closest('div').attr('id');                
                let id_bloc = element.split('_');                    
                let id = id_bloc[1]                            
                let bloc = id_bloc[0];                                           
                getEmoji(id, bloc);
            })
        $(document).click(function()
            {                
                $('#react_bloc').remove();
            })
    });
    /**
     * Permet d'afficher les emoji pour ajouter une réaction à un bloc, fait appel à insertEmoji
     * @param {number} id_bloc 
     * @param {string} bloc 
     */
    function getEmoji(id_bloc, bloc)
        {            
            $.ajax(
                {
                    url : 'App/Controller/IndexController',
                    type : 'post',
                    data : {action : 'getEmoji'},
                    success : (data) =>
                        {                                  
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
    /**
     * Insert un emjoi en base de données et fais appel à getPostEmoji
     * @param {number} id_react 
     * @param {number} id_bloc 
     * @param {string} bloc 
     */
    function insertMoji(id_react, id_bloc, bloc)
        {
            $.ajax(
                {
                    url : 'App/Controller/IndexController',
                    type : 'post',
                    data : {action : 'insertEmoji', id_react : id_react, id_bloc : id_bloc, bloc : bloc},
                    success : (data) =>
                        {             
                            getPostEmoji(id_bloc, id_react);                    
                            // let reaction = JSON.parse(data);                            
                            // $.map(reaction, function (e)
                            //     {
                            //         console.log(e.emoji);
                            //         $('#reaction_post_'+id_bloc).append('<i class="'+e.emoji+'"/>');
                            //     });

                        }
                });
        }
    /**
     * Permet de changer l'affichage des reactions à l'ajout d'une nouvelle réaction
     * @param {number} id id du post
     * @param {number} id_react id de la réaction ajouté
     */
    function getPostEmoji(id, id_react)
        {            
          $.ajax(
            {
              url : 'App/Controller/IndexController',
              type : 'post',
              data : {action : 'getPostEmoji'},
              success : (data)=>
                {
                  let allReact = JSON.parse(data);
                  $('#reaction_post_'+id).html('');
                  $.map(allReact, function(e)
                    {                                 
                      if(e.posts_id === id)
                        {                            
                            // let hasClass = $('#reaction_post.i').classList.contains(e.emoji);
                            // console.log(hasClass);
                            // if(e.reacts_id === id_react )
                            //     {

                            //     }
                          $('#reaction_post_'+id).append('<i class="'+e.emoji+'"></i>');
                        }
                    });
                }
            });
        }