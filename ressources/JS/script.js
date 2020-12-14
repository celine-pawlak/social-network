$(function ()
    {       
      console.log(localStorage);           
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
                  var datauser = {};
                  for (var i = 0; i < user.length; i++) 
                    {
                      datauser[user[i].first_name + ' ' + user[i].last_name] = datauser[user[i].picture_profil];
                    }                  
                  $('input.autocomplete').autocomplete(
                    {
                    data: datauser,
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
                        // localStorage.clear();                        
                        pageConnexion();                        
                      },
                  });
            });
          $('#prof_h').click(function()
            {
              
            });
    });
function redirectHeader(page)
    {
      $.ajax(
        {
          url : 'App/Controller/IndexController',
          type : 'post',
          data : {action : page},
          success : (data)=>
            {
              $('body').html(data);
            },
        });
    }