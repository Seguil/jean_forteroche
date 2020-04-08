//Lancement des fonctions au chargement de la page
// window.addEventListener('load', () => { //fonction fléchée sur 2 lignes = accolades/ fonction fléchée sur 1 ligne = pas d'accolades
//     lyon.deleteReportComment() //chargement de la map
// });

document.getElementById('drc').addEventListener('click', e => {
        deleteComment.ajaxGet('http://localhost/jean_forteroche/delete-report-comment.html', (response) => {
            JSON.parse(response);
        });
        // e.preventDefault();
        console.log('after');

});

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


//Au click sur le bouton réserver, le formulaire de réservation s'affiche
// document.getElementById('reservation_button').addEventListener('click', e => {
//     document.getElementById('formulaire').style.visibility = 'visible';
//     document.getElementById('voilebleu').style.display = 'flex';
//     document.getElementById('clear').style.visibility='hidden';
//     document.getElementById('submit_button').style.visibility='hidden';
//     document.getElementById('idname').value = localStorage.getItem('name');
//     document.getElementById('idfirstname').value = localStorage.getItem('firstname');
// });