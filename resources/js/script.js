function modoEscuro() {

    document.body.classList.toggle("dark");

}

setTimeout(() => {

    let notificacao =
        document.querySelector(".notificacao");

    if(notificacao){
        notificacao.style.display = "none";
    }

}, 5000);