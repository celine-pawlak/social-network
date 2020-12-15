$(function() {
  $("#form_hobbies").submit(function(e) {
    e.preventDefault();

    $.ajax({
      url:"Controller/ProfilController",
      //url: "addHobbies",
      type: "POST",
      data: {
        action : 'addHobbies',
        hobby1: $("input[name=hobby1]").val(),
        hobby2: $("input[name=hobby2]").val(),
        hobby3: $("input[name=hobby3]").val()
      }
    })

  })

  $("#form_tech").submit(function(e) {
    e.preventDefault();

    $.ajax({
      url: "addTechnologies",
      type: "POST",
      data: {
        tech1: $("input[name=tech1]").val(),
        tech2: $("input[name=tech2]").val(),
        tech3: $("input[name=tech3]").val()
      }
    })

  })

  $("#form_presentation").submit(function(e) {
    e.preventDefault();

    $.ajax({
      url: "updatePresentation",
      type: "POST",
      data: {
        presentation: $("#update_presentation").val()
      }

    })

  })

  $("#scale-infos").click(function(){
    if($("#infos-toggle").hasClass("scale-out")){
      $("#infos-toggle").removeClass("scale-out");
      $("#infos-toggle").addClass("scale-in");
      $("#infos-toggle").removeClass("display-none");
    }else{
      $("#infos-toggle").addClass("scale-in");
      $("#infos-toggle").addClass("display-none");
      $("#infos-toggle").addClass("scale-out");
    }
  })
})
