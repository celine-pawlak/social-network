$(function() {

  $("form.form_comment").submit(function(e) {

    e.preventDefault();
    var formData = new FormData($(this)[0]);

    $.ajax({
      url: "/social-network/ajouterCommentaire",
      type: "POST",
      processData: false,
      contentType: false,
      data: formData,
      success: function(data) {
        data = $.parseJSON(data);
        $("#commentaires_post_"+data.posts_id).append('<div class="post comment_profile p-1 z-depth-1"><div class="flex-row"><img class="circle miniature_img" src="'+window.location.origin+'/social-network/ressources/img/'+data.picture_profil+'"><p class="bold-text ml-05">'+data.first_name+' '+data.last_name+'</p></div><p>'+data.content+'</p><p class="grey-text right-align">'+data[14]+'</p></div>');
      }
    })

    // ajouter le commentaire
    /*
    <div class="post comment_profile p-1 z-depth-1">
      <div class="flex-row">
        <img class="circle miniature_img" src="<?= URL.'ressources/img/'. $commentaire['picture'] ?>">
        <p class="bold-text ml-05"><?= $commentaire["first_name"] . " " . $commentaire["last_name"] ?></p>
      </div>

      <p><?= $commentaire["comment"] ?></p>
      <p class="grey-text right-align"><?= $commentaire["date"] ?></p>
    </div>
    */

  })

  $(".form_comment_wall").submit(function(e) {

    e.preventDefault();
    var formData = new FormData($(this)[0]);

    $.ajax({
      url: "/social-network/ajouterCommentaireWall",
      type: "POST",
      processData: false,
      contentType: false,
      data: formData,
      success: function(data) {
        data = $.parseJSON(data);
        $("#commentaires_post_"+data.posts_id).append('<div class="post comment_profile p-1 z-depth-1"><div class="flex-row"><img class="circle miniature_img" src="'+window.location.origin+'/social-network/ressources/img/'+data.picture_profil+'"><p class="bold-text ml-05">'+data.first_name+' '+data.last_name+'</p></div><p>'+data.content+'</p><p class="grey-text right-align">'+data[14]+'</p></div>');
      }
    })
  })

})
