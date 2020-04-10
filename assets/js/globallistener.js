function afficher(elt) {
    document.getElementById(elt).style.display = 'flex';
    return false;
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

const reportButtons = document.querySelectorAll('.buttonReportComment');
console.log(reportButtons);

for(let i = 0; i < reportButtons.length; i++) {
    console.log(reportButtons.length);

    reportButtons[i].addEventListener('click', (e) => {
        e.preventDefault();
        console.log('hello');
        let url = reportButtons[i].getAttribute('data-href');
        console.log (url);


        
            var req = new XMLHttpRequest();
            req.open("GET", url);
            req.addEventListener("load", () => {
                if (req.status >= 200 && req.status < 400) {
                    // Appelle la fonction callback en lui passant la réponse de la requête
                    req.responseText;
                    console.log('success');
                } else {
                    console.error(req.status + " " + req.statusText + " " + url);
                    console.log('erreur');
                }
            });
            req.addEventListener("error", function () {
                console.error("Erreur réseau avec l'URL " + url);
            });
            req.send(null);
        
    });
}
