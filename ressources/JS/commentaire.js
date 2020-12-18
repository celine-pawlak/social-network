$(function() {
  $("#form_commentaire").submit(function(e) {
    e.preventDefault();

    $.ajax({
      url: "ajouterCommentaire",
      type: "POST",
      data: {
        id_user: $("input[name=id_user]").val(),
        id_post: $("input[name=id_post]").val(),
        content: $("input[name=content]").val()
      }
    })

  })
})
