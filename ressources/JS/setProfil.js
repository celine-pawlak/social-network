$(document).ready(function(){
  // Modification du profil
  $("#form_setprofil").submit(function(e) {
    e.preventDefault();

    // console.log(this);

    // var form_update = new FormData(this);
    // console.log(form_update);

    $.ajax({
      url : 'App/Controller/ProfilController',
      type : "POST",
      data : {
        action : 'updateProfil',
        first_name : $('#first_name').val(),
        last_name : $('#last_name').val(),
        password : $('#password').val(),
        new_password : $('#new_password').val(),
        conf_new_password : $('#conf_new_password').val()
      },
      // contentType: false,
      // processData: false,
      success : function(data) {
        console.log(data);
        if(data != "") {

        }
      }
    });

    if($("#update_avatar").val() != "") {
      var changer_avatar = $("#aupdate_avatarvatar")[0].files[0].name;

      if(changer_avatar != "") {
        $("#image_avatar").attr("src", "img/" + changer_avatar);
      }
    }
  })

})