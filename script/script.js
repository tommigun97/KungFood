var myIndex = 0;


function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}

// View Carrello
function carrello_view(){
  document.getElementById("id03").style.display = "block";
}

// Nascondi carrello
function carrello_out(){
  document.getElementById("id03").style.display = "none";
}

// View registration window
function opening_registration(){
  document.getElementById("id02").style.display = "block";
  document.getElementById("id01").style.display = "none";
}

// Return to login
function login_return(){
  document.getElementById("id02").style.display = "none";
  document.getElementById("id01").style.display = "block";
}


// Open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

function dropSearch(){
  document.getElementById("myDropdown").classList.toggle("show");
}

function showSearch() {
var x = document.getElementById("Demo");
if (x.className.indexOf("w3-show") == -1) {
  x.className += " w3-show";
} else {
  x.className = x.className.replace("w3-show", "");
 }
}

$(function(){
  $("#cart").click(function(){
    $("#idCart").css("display", "block");
  })
})

$(function(){
  $("#close2").click(function(){
    $("#idCart").css("display", "none");
  });
});

$(function(){
  $("#triangle").click(function(){
    $("#idAll").css("display", "block");
  })
})

$(function(){
  $("#close1").click(function(){
    $("#idAll").css("display", "none");
  });
});


$(function(){
  $("#close3").click(function(){
    $("div.w3-modal").css("display", "none");
  });
});

/*$(function () {
  $("#search").click(function () {

    $("#regFornitore").siblings().hide();
    $("#regFornitore").show();
  })*/
