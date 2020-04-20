class Ajax {

    constructor(button, url) {
        this.button = document.querySelectorAll(button);
        this.url = url

        for(let i = 0; i < this.button.length; i++) {
            console.log(this.button.length);
        
            this.button[i].addEventListener('click', (e) => {
                e.preventDefault();
                console.log('hello');
                this.url = this.button[i].getAttribute('data-href');
                console.log (this.url);
            });
        }
        
    }

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

    ajaxPost(url, callback) {
        const req = new XMLHttpRequest();
        req.open("POST", url);
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
