<?php

class AjaxHome {
    //pour montrer la page homepage, je suis la méthode showhomepage
    public function chapter($params) {
        extract($params);
        // if(isset($_GET['id'])) {
        //      $id = $_GET['id'];
    
        // };
        // $id = $_GET['id'];
//         (isset($_GET['id'])) ? $_GET['id'] : '';
// var_dump($_GET['id']);
        // $myBillet = new Billet();
        // $myBillet->setId($_GET['id']);
// var_dump($myBillet);
        $billetManager = new BilletManager();       
        $idChapter = $billetManager->read($id);
var_dump($idChapter);

        echo json_encode(serialize($idChapter));// je dois faire un serialize sinon le json_encode renvoie un tableau vide. De ce que j'ai compris c'est parce que dans Billet les fonction sont private



}

}