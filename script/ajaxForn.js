$(document).ready(function () {

    var tempo = 5000; // 5 secondi
    var users = $(".username").html();

    setInterval(function () {
        $.ajax({
            type: "POST",
            url: "notifyFornitore.php",
            //data: { user: users },
            /*success: function (response) {
                $(".notifiche").html(response);
            }*/
        });
    }, tempo);

});

