class Ajax {
    ajaxGet(url, callback) {
        var req = new XMLHttpRequest();
        req.open("GET", url);
        req.addEventListener("load", () => {
            if (req.status >= 200 && req.status < 400) {
                // Appelle la fonction callback en lui passant la réponse de la requête
                callback(req.responseText);
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
        console.log(req);
    };
};
