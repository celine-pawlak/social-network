$(function ()
    {                    
        // Dropdown header
        $('.dropdown-trigger').dropdown();
        // Search bar header                      
        $.ajax(
          {
              url : 'App/Controller/IndexController',
              type : 'post',
              data : {action : 'search'},              
              success: (response) =>
                {                                    
                  var user = JSON.parse(response);                       
                  var dataUser = {};
                  var dataUserId = {};
                  for (var i = 0; i < user.length; i++) 
                    {
                      dataUser[user[i].first_name + ' ' + user[i].last_name] = user[i].picture_profil;
                      dataUserId[user[i].first_name + ' ' + user[i].last_name] = user[i];
                    }                                            
                  $('input.autocomplete').autocomplete(
                    {
                      data: dataUser,                      
                      onAutocomplete : function(e)
                        {
                          $('input.autocomplete').val('');
                          window.location = "profil?id="+dataUserId[e].id;                          
                        },
                    });      
                },            
          });
          // Bouton déco
          $('.fa-power-off').click(function()
            {
              $.ajax(
                  {
                    url : 'App/Controller/IndexController',
                    type : 'post',
                    data : {action : 'deco'},
                    success : (data) =>
                      {                                                                      
                        localStorage.clear();                             
                        pageConnexion();       
                        window.location = 'index.php';
                      },
                  });
            });     
          //  Bouton créer conversation
          $('#create_conversation').click(function(e)
            {    
              $('#bouton_conv').remove();                                 
              $('#create_conversation').html("<div class='row' id='recherche_personne'><div class='col s12'><div class='row m-0'><div class='input-field col s12 m-0'><input type='text' id='autocomplete-conv' class='autocomplete' placeholder='Rechercher une personne...'/></div></div></div></div>");              
            });
    });
