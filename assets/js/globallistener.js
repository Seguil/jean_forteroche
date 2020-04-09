function afficher(elt) {
    document.getElementById(elt).style.display = 'flex';
}


function updateStatus(element, newValue) {
    const request = new Ajax ();
    console.log(element);//renvoie l'id de la bdd du commentaire
    console.log(newValue);//renvoie requête ajax vide

    element = newValue;
    console.log(element);
    request.ajaxGet("http://localhost/jean_forteroche/update-comment.html", (response) => {
            console.log(response);
        let datas = JSON.parse(response);
        for (let i=0; i<datas.length; i++) {
            element.value=datas.status;
        }
    });

}