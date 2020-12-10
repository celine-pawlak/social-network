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
                  var products = JSON.parse(response);
                  var dataProducts = {};
                  for (var i = 0; i < products.length; i++) 
                    {
                      dataProducts[products[i].first_name + ' ' + products[i].last_name] = dataProducts[products[i].picture_profil];
                    }
                  console.log(dataProducts);
                  $('input.autocomplete').autocomplete(
                    {
                    data: dataProducts,
                    });      
                },            
          });
    });