class NavChapters {
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
            // console.log(html);
            // .join('');

        
            // const billets = document.querySelector('.nav_chapters');
            // billets.innerHTML = html;
            
        });
        
    };
}