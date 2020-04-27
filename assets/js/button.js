class Button {

    deleteElement(url, parentdiv) {
        const requestDelete = new Ajax () 
        let parentOneComment = parentdiv.parentNode;
        let parentList = parentOneComment.parentNode;
        
        requestDelete.ajaxDelete(url, (response) => { 
            let jsonDatas = JSON.parse(response);
            console.log(jsonDatas); 
            parentList.removeChild(parentOneComment);
        });
    }

    postForm(url, parentdiv, datasForm) {
        const requestPost = new Ajax();
        let parentOneComment = parentdiv.parentNode;
        let parentList = parentOneComment.parentNode;

        requestPost.ajaxPost(url, datasForm, (response) => { 
            let jsonDatas = JSON.parse(response);
            console.log(jsonDatas);
            parentList.removeChild(parentOneComment);
        });
    }

    reportElement(url, parentdiv) {
        const requestReport = new Ajax () 
        
        requestReport.ajaxGet(url, (response) => { 
            let jsonDatas = JSON.parse(response);
            console.log(jsonDatas); 
            parentdiv.style.backgroundColor = "blue";
        });
    }
}

