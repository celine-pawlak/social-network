$(function() {

  $("form.form_commentaire").submit(function(e) {

    e.preventDefault();
    console.log($.parseHTML($(this)[0]));
    var formData = new FormData($(this)[0]);

    $.ajax({
      url: "ajouterCommentaire",
      type: "POST",
      processData: false,
      contentType: false,
      data: formData
    })

  })
})
