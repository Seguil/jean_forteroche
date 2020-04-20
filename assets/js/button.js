class Button {
    // constructor (button) {
    //     this.button = document.querySelectorAll(button);

    //     this.url = "";
        
    //     for(let i = 0; i < this.button.length; i++) {
    //         console.log(this.button.length);
            
    //         this.button[i].addEventListener('click', (e) => {
    //             e.preventDefault();
    //             console.log('hello');
    //             this.url = this.button[i].getAttribute('data-href');
    //             console.log (this.url);
    //         });
            
        
    //     }
    // }

    deleteElement(url, parentdiv) {
        const requestDelete = new Ajax () //Je crée une requête des stations qui est une nouvelle requête Ajax. Elle prendra comme paramètres l'url et la réponse
        let parentOneComment = parentdiv.parentNode;
        let parentList = parentOneComment.parentNode;

        
        requestDelete.ajaxDelete(url, (response) => { //Je lance la requête ajax qui a pour fonction response pour afficher la requête La fonction display est ainsi créée:
            let jsonDatas = JSON.parse(response);
            console.log(jsonDatas); //La réponse de la requête doit arriver en JSON
            parentList.removeChild(parentOneComment);

            // jsonDatas.parentNode.removeChild(jsonDatas);
                // let parentOne = parentdiv.parentNode;
                // let parentList = parentOne.parentNode;
                // parentList.removeChild(parentOne);
        });
    }
}

