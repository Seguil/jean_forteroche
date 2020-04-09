<?php

class AdminRedirect {

    public function createBillet($params) {
        extract($params);
        
        $myBillet = new Billet();
        $myBillet->setNumber($_POST['number'])
                ->setTitle($_POST['title'])
                ->setContent($_POST['content']);

        $billetManager = new BilletManager();
        $billetManager->create($myBillet);

        $currentView = new View();
        $currentView->redirect('admin-home-page.html');
    }


    public function reportComment($params) {
        extract($params);

        $myComment = new Comment();
        $myComment  ->setIdComment($_POST['idComment'])
                    ->setIdBillet($_POST['idBillet'])
                    ->setReport($_POST['report']);

        $commentManager = new CommentManager();
        $commentManager->flag($myComment);

        $currentView = new View();
        $currentView->redirect('admin-billet-page.html/id/' . $_POST['idBillet']);
    }

    
    public function deleteReportComment($params) {
        extract($params);
        var_dump($id);
        // $myComment = new Comment();
        // $myComment->setIdComment($id);
        $comManager = new CommentManager();
        // $commentManager->delete($id);
        $comManager->delete($id);
var_dump($comManager);
        // echo json_encode($comManager);
        $currentView = new View();
        $currentView->redirect('admin-home-page.html');
    }


    
    public function answerComment($params) {
        extract($params);
var_dump($params);
        $myComment = new Comment();
        $myComment  ->setAnswer($_POST['answer'])
                    ->setIdComment($_POST['idComment'])
                    ->setReport($_POST['report'])
                    ->setStatus($_POST['status']);
var_dump($myComment);

        $commentManager = new CommentManager();
        $commentManager->answer($myComment);
var_dump($myComment);

        $currentView = new View();
        $currentView->redirect('admin-home-page.html');
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
            $currentView->redirect('user-home-page.html');
        } else {
            $_SESSION['u_id'] = $myUser->getIdUser();
            $_SESSION['username'] = $myUser->getUsername();

            $currentView = new View();
            $currentView->redirect('admin-home-page.html');
        }
    }


    public function deconnexionUser($params) {
        //extract($params);
        unset($_SESSION['u_id']);
        unset($_SESSION['username']);

        session_destroy();

        $currentView = new View();
        $currentView->redirect('user-home-page.html');
    }
}