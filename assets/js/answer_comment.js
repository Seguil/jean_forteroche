const answerButtons = document.querySelectorAll('.buttonAnswerComment');
console.log(answerButtons);

for(let i = 0; i < answerButtons.length; i++) {
    console.log(answerButtons.length);

    answerButtons[i].addEventListener('click', (e) => {
        e.preventDefault();
        console.log('hello');

        const answerForm = answerButtons[i].querySelector('.response_comment');
        answerForm.style.display='flex';

        for(let i = 0; i < answerForm.length; i++) {
            console.log(answerForm.length);
        
            let url = answerForm[i].getAttribute('action');
            // let url = answerForm.getAttribute('action');
            console.log (url);
            
            let answer = document.getElementsByName("answer").value;
            let status = document.getElementsByName("status").value;
            let report = document.getElementsByName("report").value;
            let datas = [answer, status, report];
            
            var req = new XMLHttpRequest();
            req.open("POST", url);
            req.addEventListener("load", () => {
                if (req.status >= 200 && req.status < 400) {
                    req.responseText;
                    console.log(req.responseText);

                    let jResponse = JSON.parse(req.responseText);
                    console.log(jResponse);

                    let firstarg=answerButtons[i];
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
            req.send(datas);
        }
    });
}
