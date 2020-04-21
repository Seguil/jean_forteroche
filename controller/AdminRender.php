<?php

class AdminRender {

    public function __construct() {
        $currentView = new View();
        if($_SESSION['role'] != 'admin') return $currentView->redirect('user-home-page.html');
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        }


    }

    public function showAdminHomePage($params) {
        //extract($params);
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
    
        //
        $billets = $billetManager->readAll($depart, $billetsParPage);
        $nonPublishedBillets = $billetManager->readNonPublished();

        $commentManager = new CommentManager();
        $reportComment = $commentManager->readAllReport();
        $nonReadComment = $commentManager->readAllNonRead();

        $currentView = new View('admin_home_page');
        $currentView->renderAdmin(array('pagesTotales' => $pagesTotales, 'pageCourante' => $pageCourante, 'billets' => $billets, 'nonPublishedBillets' => $nonPublishedBillets, 'reportComment' => $reportComment, 'nonReadComment' => $nonReadComment));
        // $currentView->render(array('billets' => $billets, 'billet' => $billet));
    }


    public function adminReadBilletComments($params) {
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

        //
        $billets = $billetManager->readAll($depart, $billetsParPage);
        $billet = $billetManager->read($id);

        $commentManager = new CommentManager();
        $comments = $commentManager->readAll($id);
        
        // $commentManager = new CommentManager();
        // $comment = $commentManager->read($id);

        $currentView = new View('admin_billet_page');
        $currentView->renderAdmin(array('pagesTotales' => $pagesTotales, 'pageCourante' => $pageCourante, 'billets' =>$billets, 'billet' => $billet, 'comments' => $comments));

        // $currentView->render(array('billets' => $billets, 'billet' => $billet, 'comments' => $comments));
    }


    public function readNonPublishedBillet($params) {
        extract($params);

        $billetManager = new BilletManager();
        $billet = $billetManager->read($id);
        
        $currentView = new View('read_non_published_billet');
        $currentView->renderAdmin(array('billet' => $billet));
    }


    public function changeBillet($params) {
        extract($params);

        $billetManager = new BilletManager();
        $billet = $billetManager->read($id);
        
        $currentView = new View('change_billet');
        $currentView->renderAdmin(array('billet' => $billet));
    }


}