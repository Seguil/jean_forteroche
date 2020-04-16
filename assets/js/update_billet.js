const publishedButtons = document.querySelectorAll('.buttonPublishedBillet');
console.log(publishedButtons);

for(let i = 0; i < publishedButtons.length; i++) {
    console.log(publishedButtons.length);

    publishedButtons[i].addEventListener('click', (e) => {
        e.preventDefault();
        console.log('hello');
        let url = publishedButtons[i].getAttribute('data-href');
        console.log (url);
    
        var req = new XMLHttpRequest();
        req.open("GET", url);
        req.addEventListener("load", () => {
            if (req.status >= 200 && req.status < 400) {
                req.responseText;
                console.log(req.responseText);

                let jResponse = JSON.parse(req.responseText);
                console.log(jResponse);

                let firstarg=publishedButtons[i];
                let parentdiv = firstarg.parentNode;
                let parentOneComment = parentdiv.parentNode;
                let parentList = parentOneComment.parentNode;
                parentList.removeChild(parentOneComment);
                
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
