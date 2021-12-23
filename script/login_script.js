$(function () {

  var logState = true; // indica se lo stato di login è vero
  $("div.w3-center input").css("background-color", "grey");
  $("input#first").css("background-color", "#FFC107");
  $("#logaAffamato").show();
  $("#logAffamato").siblings().hide();


  $("#regButtonAff").click(function() {
    $("input#first").css("background-color", "#FFC107");
    $("input#first").siblings().css("background-color", "grey");
    logState = false;
    $("#regAffamato").show();
    $("#regAffamato").siblings().hide();
  })

  $("#regButtonForn").click(function () {
    $("input#second").css("background-color", "#FFC107");
    $("input#second").siblings().css("background-color", "grey");
    logState = false;
    $("#regFornitore").siblings().hide();
    $("#regFornitore").show();
  })



  $("input#first").click(function () {
    $("input#first").css("background-color", "#FFC107");
    $("input#first").siblings().css("background-color", "grey");
    if (logState == true) {
      $("#logAffamato").show();
      $("#logAffamato").siblings().hide();
    } else {
      $("#regAffamato").show();
      $("#regAffamato").siblings().hide();
    }
  });

  $("input#second").click(function () {
    $("input#second").css("background-color", "#FFC107");
    $("input#second").siblings().css("background-color", "grey");
    if (logState == true) {
      $("#logFornitore").show();
      $("#logFornitore").siblings().hide();
    } else {
      $("#regFornitore").show();
      $("#regFornitore").siblings().hide();
    }
  });

  $("input#third").click(function () {
    logState = true;
    $("form#logAdmin").show();
    $("form#logAdmin").siblings().hide();
    $("input#third").css("background-color", "#FFC107");
    $("input#third").siblings().css("background-color", "grey");

  });




});
