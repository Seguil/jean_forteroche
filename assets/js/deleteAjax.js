const deleteButtons = document.querySelectorAll('.buttonDeleteComment');
console.log(deleteButtons);

for(let i = 0; i < deleteButtons.length; i++) {
    console.log(deleteButtons.length);

    deleteButtons[i].addEventListener('click', (e) => {
        e.preventDefault();
        console.log('hello');
        let url = deleteButtons[i].getAttribute('data-href');
        console.log (url);
    
        var req = new XMLHttpRequest();
        req.open("DELETE", url);
        req.addEventListener("load", () => {
            if (req.status >= 200 && req.status < 400) {
                // Appelle la fonction callback en lui passant la réponse de la requête
                // req.responseText;
                // console.log(req.responseText);
                // JSON.parse(req.responseText);                
                let one = document.querySelector('.test');
                let two = document.querySelector('.test_ajax');
                one.removeChild(two);

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
