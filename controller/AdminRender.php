<?php

class AdminRender {

    public function showAdminHomePage($params) {
        //extract($params);
        $billetManager = new BilletManager();
        $billetsTotal = $billetManager->pagination();

        //Eléments pour la pagination
        $billetsParPage = 3;
        $pagesTotales = ceil($billetsTotal/$billetsParPage);
        if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page']>0 AND $_GET['page']<=$pagesTotales) {
            $_GET['page'] = intval($_GET['page']);
            $pageCourante = $_GET['page'];
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

        $billetManager = new BilletManager();
        $billetsTotal = $billetManager->pagination();

        //Eléments pour la pagination
        $billetsParPage = 3;
        $pagesTotales = ceil($billetsTotal/$billetsParPage);
        if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page']>0 AND $_GET['page']<=$pagesTotales) {
            $_GET['page'] = intval($_GET['page']);
            $pageCourante = $_GET['page'];
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
}