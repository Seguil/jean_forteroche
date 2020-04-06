<?php

class AjaxHome {
    //pour montrer la page homepage, je suis la méthode showhomepage
    public function chapter($params) {
        //extract($params);
        // if(isset($_GET['id'])) {
        //     $id = $_GET['id'];
    
        // };
        $myBillet = new Billet();
        $id = (isset($_GET['id'])) ? $_GET['id'] : '';
        $myBillet->setId($id);
var_dump($id);
        $billetManager = new BilletManager();       
        $idChapter = $billetManager->read($myBillet);
var_dump($myBillet);
        echo json_encode($idChapter); // ne pas mettre return car sinon c'est unexpected
    }
}