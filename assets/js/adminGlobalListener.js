//
// Gestion des commentaires
//

// Suppression des commentaires
const deleteButtons = document.querySelectorAll('.buttonDeleteComment');
for(let i = 0; i < deleteButtons.length; i++) {
    deleteButtons[i].addEventListener('click', (e) => {
        e.preventDefault();
        let url = deleteButtons[i].getAttribute('data-href');
        let parentdiv = deleteButtons[i].parentNode;
        deleteComment.deleteElement(url, parentdiv);
    });
}

//Passer les commentaires signalés de report on à report off 
const ignoredButtons = document.querySelectorAll('.buttonIgnoredReport');
for(let i = 0; i < ignoredButtons.length; i++) {
    ignoredButtons[i].addEventListener('click', (e) => {
        e.preventDefault();
        let url = ignoredButtons[i].getAttribute('data-href');
        let parentdiv = ignoredButtons[i].parentNode;
        ignoredBillet.deleteElement(url, parentdiv);
    });
}


//Passer les commentaires de statut non lu à lu
const statusButtons = document.querySelectorAll('.buttonStatusComment');
for(let i = 0; i < statusButtons.length; i++) {
    statusButtons[i].addEventListener('click', (e) => {
        e.preventDefault();
        let url = statusButtons[i].getAttribute('data-href');
        let parentdiv = statusButtons[i].parentNode;
        statusComment.deleteElement(url, parentdiv);
    });
}


//Répondre à un commentaire
const answerButtons = document.querySelectorAll('.buttonAnswerComment');
for(let i = 0; i < answerButtons.length; i++) {
    answerButtons[i].addEventListener('click', (e) => {
        // e.preventDefault();
        let answerForm = answerButtons[i].getElementsByTagName('form');
        for (let i=0;i<answerForm.length;i+=1){
            answerForm[i].style.display = 'flex';
            answerForm[i].addEventListener('submit', (e) => {
                e.preventDefault();
                let url = answerForm[i].getAttribute('action');
                let parentdiv = answerForm[i].parentNode;
                let pseudoForm = answerForm[i].getElementsByName('pseudo').value;
                let ansForm = answerForm[i].getElementsByName('answer').value;
                let statusForm = answerForm[i].getElementsByName('status').value;
                let idCommentForm = answerForm[i].getElementsByName('idComment').value;
                let reportForm = answerForm[i].getElementsByName('report').value;
                let datasForm = [pseudoForm, ansForm, statusForm, idCommentForm, reportForm]
                postAnswer.postForm(url, parentdiv, datasForm);
            });
        }
    });
}



//
// Gestion des billets
//

// Suppression des billets
const deleteBilletButtons = document.querySelectorAll('.buttonDeleteBillet');
for(let i = 0; i < deleteBilletButtons.length; i++) {
    deleteBilletButtons[i].addEventListener('click', (e) => {
        e.preventDefault();
        let url = deleteBilletButtons[i].getAttribute('data-href');
        let parentdiv = deleteBilletButtons[i].parentNode;
        deleteBillet.deleteElement(url, parentdiv);
    });
}


//Passer les billets de statut non publié à publié
const publishedButtons = document.querySelectorAll('.buttonPublishedBillet');
for(let i = 0; i < publishedButtons.length; i++) {
    publishedButtons[i].addEventListener('click', (e) => {
        e.preventDefault();
        let url = publishedButtons[i].getAttribute('data-href');
        let parentdiv = publishedButtons[i].parentNode;
        publishedBillet.deleteElement(url, parentdiv);
    });
}



      
