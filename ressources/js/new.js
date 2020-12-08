$(function () {
    $.ajax(
        {
            url: 'Controller/IndexController.php',
            type: 'post',
            data: {action: 'getmoji'},
            success: (data) => {
                console.log(data);
            }
        });
});