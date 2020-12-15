$(document).ready(function(){
      // Modification du profil
  $("#profil").submit(function(e) {
    e.preventDefault();
    $.ajax({
      url: "ressources/php/modifier_profil.php",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function(data) {

        if(data != "") {
          $(".erreur").removeClass("hidden");
          $(".erreur").text(data);
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