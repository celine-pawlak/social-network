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
                  for (var i = 0; i < user.length; i++) 
                    {
                      dataUser[user[i].first_name + ' ' + user[i].last_name] = dataUser[user[i].picture_profil];
                    }                  
                  $('input.autocomplete').autocomplete(
                    {
                      data: dataUser,
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
          $('.dropdown-content').click(function(e)
            {
              // e.preventDefault();
              let test = $(this).children().attr('id');
              console.log(test)
              // redirectHeader();
            });
    });
function redirectHeader(page)
    {
      $.ajax(
        {
          url : 'App/Controller/ProfilController',
          type : 'post',
          data : {action : page},
          success : (data)=>
            {
              $('body').html(data);
            },
        });
    }