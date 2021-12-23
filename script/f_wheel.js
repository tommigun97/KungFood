$(function () {
    var wheel = document.querySelector("#wheel2");
    var rando = 0;
    $('#button').click(function () {


        rando += (Math.random() * 360) + 2880;


        wheel.style.webkitTransform = "rotate(" + rando + "deg)";
        wheel.style.mozTransform = "rotate(" + rando + "deg)";
        wheel.style.msTransform = "rotate(" + rando + "deg)";
        wheel.style.transform = "rotate(" + rando + "deg)";

    });

});
