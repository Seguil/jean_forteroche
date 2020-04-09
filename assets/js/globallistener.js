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

const reportButtons = document.querySelectorAll('buttonReportComment');
console.log(reportButtons);

for(let i = 0; i <= reportButtons.length; i++) {
    console.log('hello1');

    reportButtons[i].addEventListener('click', (e) => {
        e.preventDefault();
        console.log('hello');
        let url = this.getAttribute('data-href');
        
    });
}
