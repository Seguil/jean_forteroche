const ignoredButtons = document.querySelectorAll('.buttonIgnoredReport');
console.log(ignoredButtons);

for(let i = 0; i < ignoredButtons.length; i++) {
    console.log(ignoredButtons.length);

    ignoredButtons[i].addEventListener('click', (e) => {
        e.preventDefault();
        console.log('hello');
        let url = ignoredButtons[i].getAttribute('data-href');
        console.log (url);
    
        var req = new XMLHttpRequest();
        req.open("GET", url);
        req.addEventListener("load", () => {
            if (req.status >= 200 && req.status < 400) {
                req.responseText;
                console.log(req.responseText);

                let jResponse = JSON.parse(req.responseText);
                console.log(jResponse);

                let firstarg=ignoredButtons[i];
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
