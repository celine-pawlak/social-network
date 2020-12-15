$(document).ready(function(){
  // Modification du profil
  $("#form_setprofil").submit(function(e) {
    e.preventDefault();

    $.ajax({
      url: "App/Controller/ProfilController",
      method: "POST",
      data: {
        action : 'updateProfil',
        donnee : new FormData(this)
      },
      contentType: false,
      cache: false,
      processData: false,
      success: function(data) {
        console.log(data);
        if(data != "") {

        }
      }
    })

    if($("#avatar").val() != "") {
      var changer_avatar = $("#avatar")[0].files[0].name;

      if(changer_avatar != "") {
        $("#image_avatar").attr("src", "img/" + changer_avatar);
      }
    }
  })

})