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
                req.responseText;
                reportButtons[i].style.backgroundColor = "green";
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
