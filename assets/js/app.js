function displayChapters(){
    // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier handler.php
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET","<?php echo CLASSES;?>Routeur.php");
  
    // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
    requeteAjax.onload = function(){
      const resultat = JSON.parse(requeteAjax.responseText);
      for (let i=0; i<dataBillets.length; i++) {
        let billet = dataBillets[i]; //Je récupère les stations sous forme de tableau
       // Je récupère les informations pour l'affichage des infos 
       let number = billet.number;
       let title = billet.title;
   // const html = dataBillets.map(function(getBillets){
   //     return `
   //         <div class="nav_chapters">
   //             <h2 class="number">${getBillets.number}</h2>
   //             <h3 class="title">${getBillets.title}</h3>
   //         </div>
   //     `
       document.querySelector('.number').innerHTML = number;
       document.querySelector('.title').innerHTML = title;

   };
}
  
    // 3. On envoie la requête
    requeteAjax.send();
}