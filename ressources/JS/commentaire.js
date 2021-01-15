$(function() {

  $('.commentaires_posts').hide();
  $('.show-comments').click(function(){
    var id_post = this.id.replace("see_comments_from", "commentaires");
    $('#'+id_post+'').show();
    //hide de nouveau
    //changer l'html de p et son id
    
  })

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

  });

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
        $("#commentaires_post_"+data.posts_id).append('<div class="post comment_profile border-radius-10px box-shadow background-white black-text m-1 p-05 flex-row  ml-1">\n' +
            '                                <img class="circle miniature_img self-align-center"\n' +
            '                                     src="'+window.location.origin+'/social-network/ressources/img/'+data.picture_profil+'">\n' +
            '                                <div class="flex-1 flex-column">\n' +
            '                                    <div class="flex-row justify-content-spacebetween">\n' +
            '                                        <p class="bold-text font-smile-small pl-05 m-0">'+data.first_name+' '+data.last_name+'</p>\n' +
            '                                        <p class="grey-text right-align font-smile-small m-0">'+data[14]+'</p>\n' +
            '                                    </div>\n' +
            '                                    <p class="pl-05 m-0 content-fit-height word-break-all">'+data.content+'</p>\n' +
            '                                </div>\n' +
            '                            </div>');
        $("#comment_post_"+data.posts_id).val('');
      }
    })
  })

})
