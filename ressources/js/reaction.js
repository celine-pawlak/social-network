$(function()
    {        
        $.ajax(
            {
                url : 'App/Controller/IndexController.php',
                type : 'post',
                data : {action : 'getmoji'},
                success : (data) =>
                    {
                        console.log(data);
                    }
            });
        // $('.react').click(function()
        //     {
        //         let id_post = $(this).attr('id');

        //         $.ajax(
        //             {
        //                 url : '../../Controller/IndexController.php',
        //                 type : 'post',
        //                 data : {post_id : id_post, action : 'getmoji'},
        //                 success : (data) =>
        //                     {
        //                         console.log(data);
        //                     }
        //             });
        //     })
    });