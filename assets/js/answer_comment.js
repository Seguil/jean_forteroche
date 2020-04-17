const answerButtons = document.querySelectorAll('.buttonAnswerComment');
console.log('answerButtons is known');
let answerForm="";

for(let i = 0; i < answerButtons.length; i++) {
    console.log(answerButtons.length);

    answerButtons[i].addEventListener('click', (e) => {
        e.preventDefault();
        console.log('clic answer button is ok');

        answerForm = answerButtons[i].querySelector('.response_comment');
        answerForm.style.display='flex';
        console.log('fin affichage');
    });
};

const submitForm = document.querySelectorAll('.response_comment input[type="submit"]');
console.log('submitForm is known');

for(let i = 0; i < submitForm.length; i++) {
    console.log(submitForm.length);

    submitForm[i].addEventListener('click', (e) => {
        e.preventDefault();
        console.log('submiltForm is ok');


        for(let i = 0; i < answerForm.length; i++) {
            console.log(answerForm.length);
        
            // let url = answerForm[i].getElementsByName('action').value;
            let url = answerForm.getAttribute('action');
            console.log (url);

            let status = answerForm.querySelector('input[name="status"]').value;
            console.log(status);
            let idComment = answerForm.querySelector('input[name="idComment"]').value;
            console.log(idComment);
            let answer = answerForm.querySelector('input[name="answer"]').value;
            console.log(answer);
            let report = answerForm.querySelector('input[name="report"]').value;
            console.log(report);

//             let formDatas = new FormData();
//             formDatas.append("status", status);
//             formDatas.append("idComment", idComment);
//             formDatas.append("answer", answer);
//             formDatas.append("report", report);
// console.log(formDatas);

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
            req.send(status, idComment, answer, report);
        }
    });
};
