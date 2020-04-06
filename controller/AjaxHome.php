<?php

class AjaxHome {
    //pour montrer la page homepage, je suis la méthode showhomepage
    public function chapter($params) {
        extract($params);
        $id = (isset($_GET['id'])) ? $_GET['id'] : '';
        
        $billetManager = new BilletManager();       
        $idChapter = $billetManager->read($id);
        
        // echo json_encode($idChapter); // ne pas mettre return car sinon c'est unexpected

    }