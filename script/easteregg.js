$(function(){

    var cont= 6;

    $("#easter").click(function(){
        cont--;
        console.log(cont);
        if(cont == 0){
            window.alert("Bella la barzelletta...Bello il progetto, il 30 è assicurato ahah\nP.S. Sappiamo che non si devono usare gli alert");
            cont = 6;
        }
    });

});
