class Ajax {

    ajaxGet(url, callback) {
        const req = new XMLHttpRequest();
        req.open("GET", url);
        req.addEventListener("load", () => {
            if (req.status >= 200 && req.status < 400) {
                callback(req.responseText);
            } else {
                console.error(req.status + " " + req.statusText + " " + url);
            }
        });
        req.addEventListener("error", function () {
            console.error("Erreur réseau avec l'URL " + url);
        });
        req.send();
    };


    ajaxPost(url, jsonBody, callback) {
        const req = new XMLHttpRequest();
        req.open("POST", url);
        request.setRequestHeader("Content-Type", "application/json");
        req.addEventListener("load", () => {
            if (req.status >= 200 && req.status < 400) {
                callback(req.responseText);
            } else {
                console.error(req.status + " " + req.statusText + " " + url);
            }
        });
        req.addEventListener("error", function () {
            console.error("Erreur réseau avec l'URL " + url);
        });
        req.send(JSON.stringify(jsonBody));
    };

    
    ajaxDelete(url, callback) {
        const req = new XMLHttpRequest();
        req.open("DELETE", url);
        req.addEventListener("load", () => {
            if (req.status >= 200 && req.status < 400) {
                callback(req.responseText);
            } else {
                console.error(req.status + " " + req.statusText + " " + url);
            }
        });
        req.addEventListener("error", function () {
            console.error("Erreur réseau avec l'URL " + url);
        });
        req.send();
    };


};
