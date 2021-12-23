$(function(){
$('#reset').hide();
 $("#wrapper").css("display" , "none");
$("#spin").click(function( event ) {
  $('#spin').hide();


  $('#reset').show();
  // Generate a number between 1 and 6
    var prize = (Math.floor(Math.random() * 6));
  // Spin to the angle of the segment based on the random number
    var segmentAngle = ((prize - 1) * -60);
  // Add on 3 full spins
    var segmentAngle = segmentAngle + 1080;

  var wheel = document.getElementById("backdrop");

  // The animation class is only needed for the reset button, it makes the transition smooth instead of instant
    $('.backdrop').addClass("animate");

  // Add a transition directly to the wheel
    wheel.style.webkitTransform = 'rotate('+segmentAngle+'deg)';
    wheel.style.mozTransform    = 'rotate('+segmentAngle+'deg)';
    wheel.style.msTransform     = 'rotate('+segmentAngle+'deg)';
    wheel.style.oTransform      = 'rotate('+segmentAngle+'deg)';
    wheel.style.transform       = 'rotate('+segmentAngle+'deg)';

  // Display the result


    console.log(prize+1);
    document.getElementById("result").innerHTML = document.getElementById(prize+1).innerHTML;
    //document.getElementById("result").innerHTML = "Congrats you got " + prize;



  });

/*$('#reset').click(function( event ) {
    // Removing the animation class means we don't follow the animation duration
  $('#backdrop').removeClass("animate");

  // Set the wheel's CSS back to the starting position
  $("#backdrop").css({
          '-moz-transform':'rotate(0)',
          '-webkit-transform':'rotate(0)',
          '-o-transform':'rotate(0)',
          '-ms-transform':'rotate(0)',
          'transform':'rotate(0)'
     });

    document.getElementById("result").innerHTML = "";
  }, false);*/
document.getElementById("result").innerHTML = "";
  $(this).one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",
              function(event) {
    $('#wrapper').show();


  });
})
