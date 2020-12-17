$(document).ready(function(){
  // Modification du profil
  $("#form_setprofil").submit(function(e) {
    e.preventDefault();

    // var avatar = $('#update_avatar').val();
    // console.log(avatar);
    // $('#image_avatar').attr('src', avatar);


    // console.log(document.getElementById("form_setprofil"));
    $.ajax({
      url : 'App/Controller/ProfilController',
      method: "POST",
      data: {
        action : 'updateProfil',
        donnee : new FormData(document.getElementById("form_setprofil"))
      },
      contentType: multipart/form-data,
      cache: false,
      processData: false,
      success : function(data) {
        console.log(data);
        if(data != "") {

        }
      }
    });

    if($("#update_avatar").val() != "") {
      var changer_avatar = $("#update_avatar")[0].files[0].name;

      if(changer_avatar != "") {
        $("#image_avatar").attr("src", "img/" + changer_avatar);
      }
    }
  })

})