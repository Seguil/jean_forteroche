document.getElementById('connect_button').addEventListener('click', (e) => {
    document.getElementById('connect_button').style.display = 'none';
    document.getElementById('form').style.display = 'flex';
});

document.getElementById('annulation_connect').addEventListener('click', (e) => {
    document.getElementById('connect_button').style.display = 'flex';
    document.getElementById('form').style.display = 'none';
});

// Signaler un commentaire
const reportButtons = document.querySelectorAll('.buttonReportComment');
for(let i = 0; i < reportButtons.length; i++) {
    reportButtons[i].addEventListener('click', (e) => {
        e.preventDefault();
        let url = reportButtons[i].getAttribute('data-href');
        let parentdiv = reportButtons[i];
        reportComment.reportElement(url, parentdiv);
    });
}
