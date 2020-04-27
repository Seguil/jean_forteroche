<?php

class UserRender {
    public function __construct() {
        $currentView = new View();
        if(isset($_SESSION['u_id'])) {
            unset($_SESSION['u_id']);
            session_destroy();
        };
    }

    
    public function showHomePage($params) {

        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        }

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

        $billets = $billetManager->readAll($depart, $billetsParPage);

        $currentView = new View('user_home_page');
        $currentView->render(array('pagesTotales' => $pagesTotales, 'pageCourante' => $pageCourante, 'billets' => $billets));
    }


    public function readBilletComments($params) {
        extract($params);

        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        }

        $billetManager = new BilletManager();
        $billetsTotal = $billetManager->pagination();

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

        $billets = $billetManager->readAll($depart, $billetsParPage);
        $billet = $billetManager->read($number);

        $commentManager = new CommentManager();
        $comments = $commentManager->readAll($number);
        
        $currentView = new View('user_billet_page');
        $currentView->render(array('pagesTotales' => $pagesTotales, 'pageCourante' => $pageCourante,'billets' =>$billets, 'billet' => $billet, 'comments' => $comments));
    }

}