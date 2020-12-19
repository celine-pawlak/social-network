$(document).ready(function(){
  $(function () {
      // Vérifie que le mail soit au format prenom.nom@laplateforme.io
      $('#email').keyup(function () {
          regexMailValide(this, 'nope', 'yep');
      });
      // Vérifie la sécurité du mot de passe
      $('#password').keyup(function () {
          regexPasswordValide(this, 'nope', 'yep');
      });
      // Vérifie que les mots de passe correspondent
      $('#conf_password').keyup(function () {
          isTheSame(this, $('#password'), 'nope', 'yep');
      });
  });

  // Modification du profil
  $('#form_setprofil').submit(function(e){
    e.preventDefault();

    var infos = new FormData(document.getElementById('form_setprofil'));
    infos.append('action', 'updateProfil');
    infos.append('first_name', $('#first_name').val());
    infos.append('last_name', $('#last_name').val());
    infos.append('mail', $('#mail').val());
    infos.append('current_password', $('#current_password').val());
    infos.append('new_password', $('#new_password').val());
    infos.append('conf_new_password', $('#conf_new_password').val());

    $.ajax({
      url: "App/Controller/ProfilController",
      method: "POST",
      data: infos,
      contentType: false,
      cache: false,
      processData: false,
      success: function(data) {
        console.log(data);
        if(data != "") {
          if($("#update_avatar").val() != "") {
            var changer_avatar = $("#update_avatar")[0].files[0].name;

            if(changer_avatar != "") {
              $("#image_avatar").attr("src", "ressources/img/" + changer_avatar);
            }
          }

          $('#fichier').val('');
          $('#current_password').val('');
          $('#new_password').val('');
          $('#conf_new_password').val('');
        }
      }
    })
  });

})