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
                req.responseText;
                console.log(req.responseText);
                JSON.parse(req.responseText);                

                let firstarg=deleteButtons[i];
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