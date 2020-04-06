class Chapters {
    constructor(id, url) {
        this.id = document.querySelector(id); 
        this.url = url;
    }

    displayChapters() {
        const requestBillets = new Ajax () //Je crée une requête des stations qui est une nouvelle requête Ajax. Elle prendra comme paramètres l'url et la réponse
        
        requestBillets.ajaxGet(this.url, (response) => {
            let dataBillets = JSON.parse(response);
            // console.log(response);
            for (let i=0; i<dataBillets.length; i++) {
                let billet = dataBillets[i]; //Je récupère les stations sous forme de tableau
                // Je récupère les informations pour l'affichage des infos 
                let numberBillet = document.createElement("h2");
                numberBillet.innerHTML = billet.number;
                this.id.appendChild(numberBillet);
        
                let titleBillet = document.createElement("h2");
                titleBillet.innerHTML = billet.title;
                this.id.appendChild(titleBillet);
        
                let contentBillet = document.createElement("p");
                contentBillet.innerHTML = billet.content;
                this.id.appendChild(contentBillet);
            };            
        });
        
    };
}