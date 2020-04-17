const selectBilletLink = document.querySelectorAll('.selectBillet');
console.log(selectBilletLink);

for(let i = 0; i < selectBilletLink.length; i++) {
    console.log(selectBilletLink.length);

    selectBilletLink[i].addEventListener('click', (e) => {
        e.preventDefault();
        console.log('hello');
        let url = selectBilletLink[i].getAttribute('data-href');
        console.log (url);
    
        var req = new XMLHttpRequest();
        req.open("GET", url);
        req.addEventListener("load", () => {
            if (req.status >= 200 && req.status < 400) {
                req.responseText;
                console.log(req.responseText);

                let jResponse = JSON.parse(req.responseText);
                console.log(jResponse);
                for (let i=0; i<jResponse.length; i++) {
                    let datasChapter = jResponse[i]; //Je récupère les stations sous forme de tableau
    

                    let displayNumber = datasChapter.number;
                    let displayTitle = datasChapter.title;
                    let displayContent = datasChapter.content;
                    let displayDate = datasChapter.date;
                    
                    document.getElementbyId('display_number').innerHTML = 'Chapitre n° ' + displayNumber;
                    document.getElementbyId('display_title').innerHTML = displayTitle;
                    document.getElementbyId('display_content').innerHTML = displayContent;
                    document.getElementbyId('display_date').innerHTML = 'Publié le ' + displayDate;        

                    // let firstarg=selectBilletLink[i];
                    // let parentdiv = firstarg.parentNode;
                    // let parentOneComment = parentdiv.parentNode;
                    // let parentList = parentOneComment.parentNode;
                    // parentList.removeChild(parentOneComment);
                };
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
