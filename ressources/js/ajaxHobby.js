$(function() {
  $("#form_hobbies").submit(function(e) {
    e.preventDefault();

    $.ajax({
      url: "addHobbies",
      type: "POST",
      data: {
        hobby1: $("input[name=hobby1]").val(),
        hobby2: $("input[name=hobby2]").val(),
        hobby3: $("input[name=hobby3]").val()
      }
    })

  })
})
