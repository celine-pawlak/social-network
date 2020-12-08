$(function()
    {          
        getMoji().click()
        insertMoji();
        // $('.react').click(function()
        //     {
        //         let id_post = $(this).attr('id');

        //             $.ajax(
        //                 {
        //                     url : 'App/Controller/IndexController.php',
        //                     type : 'post',
        //                     data : {action : 'getmoji'},
        //                     success : (data) =>
        //                         {
        //                             let test = JSON.parse(data);
        //                             console.log(test);
        //                             $.map(test, function (icon, type)
        //                                 {                                
        //                                     $('main').append('<p id='+type+'>'+icon+'</p>');
        //                                 })
        //                         }
        //                 });
        //     })
    });

    function getMoji()
        {
            $.ajax(
                {
                    url : 'App/Controller/IndexController.php',
                    type : 'post',
                    data : {action : 'getmoji'},
                    success : (data) =>
                        {
                            let test = JSON.parse(data);                            
                            $.map(test, function (icon, type)
                                {                                
                                    $('main').append('<p id='+type+'>'+icon+'</p>');
                                })
                        }
                });
        }
    function insertMoji()
        {
            $.ajax(
                {
                    url : 'App/Controller/IndexController.php',
                    type : 'post',
                    data : {action : 'insertEmoji'},
                    success : (data) =>
                        {
                            console.log(data);
                        }
                });
        }