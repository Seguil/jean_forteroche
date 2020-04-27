class Button {

    deleteElement(url, parentdiv) {
        const requestDelete = new Ajax () //Je crée une requête des stations qui est une nouvelle requête Ajax. Elle prendra comme paramètres l'url et la réponse
        let parentOneComment = parentdiv.parentNode;
        let parentList = parentOneComment.parentNode;
        
        requestDelete.ajaxDelete(url, (response) => { //Je lance la requête ajax qui a pour fonction response pour afficher la requête La fonction display est ainsi créée:
            let jsonDatas = JSON.parse(response);
            console.log(jsonDatas); //La réponse de la requête doit arriver en JSON
            parentList.removeChild(parentOneComment);
        });
    }

    postForm(url, parentdiv, datasForm) {
        const requestPost = new Ajax();
        let parentOneComment = parentdiv.parentNode;
        let parentList = parentOneComment.parentNode;

        requestPost.ajaxPost(url, datasForm, (response) => { //Je lance la requête ajax qui a pour fonction response pour afficher la requête La fonction display est ainsi créée:
            let jsonDatas = JSON.parse(response);
            console.log(jsonDatas); //La réponse de la requête doit arriver en JSON
            parentList.removeChild(parentOneComment);
        });
    }

    reportElement(url, parentdiv) {
        const requestReport = new Ajax () //Je crée une requête des stations qui est une nouvelle requête Ajax. Elle prendra comme paramètres l'url et la réponse
        
        requestReport.ajaxGet(url, (response) => { //Je lance la requête ajax qui a pour fonction response pour afficher la requête La fonction display est ainsi créée:
            let jsonDatas = JSON.parse(response);
            console.log(jsonDatas); //La réponse de la requête doit arriver en JSON
            parentdiv.style.backgroundColor = "blue";
        });
    }
}

