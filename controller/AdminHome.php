<?php

class AdminHome {

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

        $commentManager = new CommentManager();
        $comment = $commentManager->readAllReport();

        $currentView = new View('adminhomepage');
        $currentView->renderAdmin(array('pagesTotales' => $pagesTotales, 'pageCourante' => $pageCourante, 'billets' => $billets, 'comment' => $comment));
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

        $currentView = new View('adminBilletCommentsPage');
        $currentView->renderAdmin(array('pagesTotales' => $pagesTotales, 'pageCourante' => $pageCourante, 'billets' =>$billets, 'billet' => $billet, 'comments' => $comments));

        // $currentView->render(array('billets' => $billets, 'billet' => $billet, 'comments' => $comments));
    }

    public function createBillet($params) {
        extract($params);
        
        $myBillet = new Billet();
        $myBillet->setNumber($_POST['number'])
                ->setTitle($_POST['title'])
                ->setContent($_POST['content']);

        $billetManager = new BilletManager();
        $billetManager->create($myBillet);

        $currentView = new View();
        $currentView->redirect('adminhomepage.html');
    }

    public function reportComment($params) {
        extract($params);

        $myComment = new Comment();
        $myComment->setIdComment($_POST['idComment'])
                    // ->setComment($_POST['comment'])
                    ->setIdBillet($_POST['idBillet'])
                    // ->setCommentDate($_POST['commentDate'])
                    ->setReport($_POST['report']);

        $commentManager = new CommentManager();
        $commentManager->flag($myComment);

        $currentView = new View();
        $currentView->redirect('billetCommentsPage.html/id/' . $_POST['idBillet']);
    }

    public function readUser($params) {
        extract($params);

        $myUser = new User();
        $myUser->setUsername($_POST['username_connect'])
                ->setPassword($_POST['password_connect']);

        $userManager = new UserManager();
        $result = $userManager->read($myUser);
        
        if($result===false) {
            $currentView = new View();
            $currentView->redirect('homepage.html');
        } else {
            $_SESSION['u_id'] = $myUser->getIdUser();
            $_SESSION['username'] = $myUser->getUsername();

            $currentView = new View();
            $currentView->redirect('adminhomepage.html');
        }
    }

    public function deconnexionUser($params) {
        //extract($params);
        unset($_SESSION['u_id']);
        unset($_SESSION['username']);

        session_destroy();

        $currentView = new View();
        $currentView->redirect('homepage.html');
}
}