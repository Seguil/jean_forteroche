<?php

class UserHome {
    //pour montrer la page homepage, je suis la méthode showhomepage
    public function showHomePage($params) {
        //extract($params);
        $billetManager = new BilletManager();
        
        $billetsTotal = $billetManager->pagination();

        //Eléments pour la pagination
        $billetsParPage = 6;
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

        $currentView = new View('user_home_page');
        $currentView->render(array('pagesTotales' => $pagesTotales, 'pageCourante' => $pageCourante, 'billets' => $billets));
    }


    public function createUser($params) {
        extract($params);
        
        $myUser = new User();
        $myUser->setUsername($_POST['username'])
             ->setPassword($_POST['password']);

        $userManager = new UserManager();
        $userManager->create($myUser);

        $currentView = new View();
        $currentView->redirect('admin/admin-home-page.html');
    }

    public function readBilletComments($params) {
        extract($params);

        $billetManager = new BilletManager();
        $billetsTotal = $billetManager->pagination();
        // $billetsTotal = json_encode($billetsTotal);

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

        $currentView = new View('user_billet_page');
        $currentView->render(array('pagesTotales' => $pagesTotales, 'pageCourante' => $pageCourante,'billets' =>$billets, 'billet' => $billet, 'comments' => $comments));
        // $currentView->render(array('billet' => $billet, 'comments' => $comments));

        // $currentView->render(array('billets' => $billets, 'billet' => $billet, 'comments' => $comments));

    }

    public function createComment($params) {
        extract($params);
        $myComment = new Comment();
        $myComment->setComment($_POST['message'])
                    ->setIdBillet($_POST['billet'])
                    ->setReport($_POST['report']);
                    // ->setCommentDate($_POST['commentDate']);


        $commentManager = new CommentManager();
        $commentManager->create($myComment);

        $currentView = new View();
        $currentView->redirect('user-billet-page.html/id/' . $_POST['billet']);
    }

    // public function getJsonServices($params) {
    //     extract($params);
    //     $billetManager = new BilletManager();
    //     $billetsTotal = $billetManager->pagination();
    //     $billetsTotal = json_encode($billetsTotal);
        // $currentView = new View('billetCommentsPage');
        // $currentView->render(array('billetsTotal' => $billetsTotal));

    // }
}