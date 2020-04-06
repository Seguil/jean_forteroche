class Chapters {
    constructor(id, url) {
        this.id = document.querySelector(id); 
        this.url = url;
    }

    displayChapters() {
        const requestBillets = new Ajax () //Je crée une requête des stations qui est une nouvelle requête Ajax. Elle prendra comme paramètres l'url et la réponse
        console.log(requestBillets);
       
        requestBillets.ajaxGet(this.url, (response) => {
    console.log(this.url);
    console.log(response);

            let dataBillets = JSON.parse(response);
            for (let i=0; i<dataBillets.length; i++) {
                let billet = dataBillets[i]; //Je récupère les stations sous forme de tableau
                // Je récupère les informations pour l'affichage des infos 
                let numberBillet = document.createElement("h2");
                numberBillet.textContent = billet.number;
                this.id.appendChild(numberBillet);
        
        //         let titleBillet = document.createElement("h2");
        //         titleBillet.textContent = billet.title;
        //         this.id.appendChild(titleBillet);
        
        //         let contentBillet = document.createElement("p");
        //         contentBillet.textContent = billet.content;
        //         this.id.appendChild(contentBillet);
            };            
        });
        
    };
}