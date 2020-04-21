document.getElementById('connect_button').addEventListener('click', (e) => {
    document.getElementById('connect_button').style.display = 'none';
    document.getElementById('form').style.display = 'flex';
});

document.getElementById('annulation_connect').addEventListener('click', (e) => {
    document.getElementById('connect_button').style.display = 'flex';
    document.getElementById('form').style.display = 'none';
});