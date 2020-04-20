// document.getElementById('connect_button').addEventListener('click', (e) => {
//     document.getElementById('connect_button').style.display = 'none';
//     document.getElementById('form_connection').style.display = 'flex';
// });

// document.getElementById('annulation_connect').addEventListener('click', (e) => {
//     document.getElementById('connect_button').style.display = 'flex';
//     document.getElementById('form_connection').style.display = 'none';
// });


const deleteButtons = document.querySelectorAll('.buttonDeleteComment');
console.log(deleteButtons);

for(let i = 0; i < deleteButtons.length; i++) {
    console.log(deleteButtons.length);

    deleteButtons[i].addEventListener('click', (e) => {
        e.preventDefault();
        console.log('hello');
        let url = deleteButtons[i].getAttribute('data-href');
        let parentdiv = deleteButtons[i].parentNode;
        // let parentOneComment = parentdiv.parentNode;
        // let parentList = parentOneComment.parentNode;
        // parentList.removeChild(parentOneComment);

        console.log (url);
        console.log(parentdiv);
        deleteComment.deleteElement(url, parentdiv);
    });        


}
//function afficher(elt) {
//     document.getElementById(elt).style.display = 'flex';
//     return false;
// }
// const deleteButtons = document.querySelectorAll('.buttonDeleteComment');

// for(let i = 0; i < this.deleteButtons.length; i++) {
//     console.log(deleteButtons.length);

//     deleteButtons[i].addEventListener('click', (e) => {
//         e.preventDefault();
//         console.log('hello');
//         let url = deleteButtons[i].getAttribute('data-href');
//         console.log (url);
//         deleteComment.deleteElement();
//     });        
// };


// const deleteButtons = document.querySelectorAll('.buttonDeleteComment');

// deleteButtons.addEventListener('click', (e) => {
//     for(let i = 0; i < this.deleteButtons.length; i++) {
//         console.log(deleteButtons.length);
    
//         e.preventDefault();
//         console.log('hello');
//         let url = deleteButtons[i].getAttribute('data-href');
//         console.log (url);
//         deleteComment.deleteElement();
//     };

// });        
