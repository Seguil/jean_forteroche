//Lancement des fonctions au chargement de la page
// window.addEventListener('load', () => { //fonction fléchée sur 2 lignes = accolades/ fonction fléchée sur 1 ligne = pas d'accolades
//     lyon.deleteReportComment() //chargement de la map
// });

// document.getElementById('drc').addEventListener('click', e => {
//         deleteComment.ajaxGet('http://localhost/jean_forteroche/delete-report-comment.html', (response) => {
//             JSON.parse(response);
//         });
//         // e.preventDefault();
//         console.log('after');

// });

//Bouton de transition
// document.getElementById('transition_down').addEventListener('click', e => {
//     document.getElementById('transition_down').style.display = 'none';
//     document.getElementById('transition_up').style.display = 'flex';
//     document.getElementById('macarte').scrollIntoView({behavior: 'smooth', block: "start"})
// });

// document.getElementById('transition_up').addEventListener('click', e => {
//     document.getElementById('transition_up').style.display = 'none';
//     document.getElementById('transition_down').style.display = 'flex';
//     document.getElementById('fonctionnement').scrollIntoView({behavior: "smooth", block: "end"})
// });

document.querySelectorAll('a[href^="#"]').addEventListener('click', function (e) {
        document.getElementsByClassName('response').style.display = 'flex'
    });



//Au click sur le lien répondre, le formulaire de réponse s'affiche
// document.getElementsByClassName('response_comment').addEventListener('click', () =>  document.getElementsByClassName('response').style.display = 'flex');