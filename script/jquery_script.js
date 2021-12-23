$(function () {
 
  var logState = true; // indica se lo stato di login è vero
  $("input#first").css("background-color", "grey");
  $("input#second").css("background-color", "grey");
  $("input#third").css("background-color", "grey");
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


   $("i#Login").click(function(){
     $("div#ViewLogin").css("display", "block");
   });

   $("i#search").click(function(){
     $("input#Demo").toggle();
   });



   $("i#search").click(function(){
     $("#Demo2").toggle();
   });



   function setCharAt(str,index,chr) {
       if(index > str.length-1) return str;
       return str.substr(0,index) + chr + str.substr(index+1);
   }


   $("form#Demo2 input").keyup(function(){
     var sug = $("span#suggerimenti").html();
     var str = $("form#Demo2 input").val();
     var gn = true;
     if(sug.toString() == "no suggestion" || sug.toString() == ""){
       $("div#searcFornitore").show();
     }else{
      $("div#searcFornitore").css("display", "none");
        if(sug.includes(",")){
        while(gn){
            var index = sug.indexOf(",")
            var text = sug.substring(0, index);
            while(text.includes(" ")){
              text = setCharAt(text, text.indexOf(" "), '.');
            }
            $("div.w3-hover-opacity."+ text).css("display", "block");
            text = sug.substr(index+2);
            sug = text;
            if(!text.includes(",")){
              while(text.includes(" ")){
                text = setCharAt(text, text.indexOf(" "), '.');
              }
              $("div.w3-hover-opacity."+ text).css("display", "block");
              gn=false;
            }
        }
      }else{
        if(sug.includes(" ")){
          sug = setCharAt(sug, sug.indexOf(" "), '.');
        }
        $("div.w3-hover-opacity."+ sug).css("display", "block");
      }
     }
   });






});
