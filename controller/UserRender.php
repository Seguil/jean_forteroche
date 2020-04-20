<?php

class UserRender {
    //pour montrer la page homepage, je suis la méthode showhomepage
    public function __construct() {
        $currentView = new View();
        if(isset($_SESSION['u_id'])) {
            unset($_SESSION['u_id']);
            session_destroy();
        }
    ;
    }

    
    public function showHomePage($params) {
        //extract($params);
        $billetManager = new BilletManager();
        
        $billetsTotal = $billetManager->pagination();

        //Eléments pour la pagination
        $billetsParPage = 6;
        $pagesTotales = ceil($billetsTotal/$billetsParPage);
        if(isset($page) AND !empty($page) AND $page>0 AND $page<=$pagesTotales) {
            $page = intval($page);
            $pageCourante = $page;
        } else {
            $pageCourante = 1;
        }
        $depart = ($pageCourante-1)*$billetsParPage;

        //
        $billets = $billetManager->readAll($depart, $billetsParPage);

        $currentView = new View('user_home_page');
        $currentView->render(array('pagesTotales' => $pagesTotales, 'pageCourante' => $pageCourante, 'billets' => $billets));
    }


    public function readBilletComments($params) {
        extract($params);

        $billetManager = new BilletManager();
        $billetsTotal = $billetManager->pagination();
        // $billetsTotal = json_encode($billetsTotal);

        //Eléments pour la pagination
        $billetsParPage = 3;
        $pagesTotales = ceil($billetsTotal/$billetsParPage);
        if(isset($page) AND !empty($page) AND $page>0 AND $page<=$pagesTotales) {
            $page = intval($page);
            $pageCourante = $page;
        } else {
            $pageCourante = 1;
        }
        $depart = ($pageCourante-1)*$billetsParPage;

        //
        $billets = $billetManager->readAll($depart, $billetsParPage);
        $billet = $billetManager->read($id);

        $commentManager = new CommentManager();
        $comments = $commentManager->readAll($id);
        
        // $commentManager = new CommentManager();
        // $comment = $commentManager->read($id);

        $currentView = new View('user_billet_page');
        $currentView->render(array('pagesTotales' => $pagesTotales, 'pageCourante' => $pageCourante,'billets' =>$billets, 'billet' => $billet, 'comments' => $comments));
        // $currentView->render(array('billet' => $billet, 'comments' => $comments));

        // $currentView->render(array('billets' => $billets, 'billet' => $billet, 'comments' => $comments));

    }

}