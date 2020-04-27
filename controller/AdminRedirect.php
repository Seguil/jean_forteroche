<?php

class AdminRedirect {

    public function createBillet($params) {
        extract($params);

        $myBillet = new Billet();
        $myBillet->setNumber(htmlspecialchars($_POST['number']))
                ->setTitle(htmlspecialchars($_POST['title']))
                ->setContent(htmlspecialchars($_POST['content']))
                ->setStatus(htmlspecialchars($_POST['status']));


        $billetManager = new BilletManager();
        $billetManager->create($myBillet);

        $currentView = new View();
        $currentView->redirect('admin-home-page.html');
    }


    public function reportComment($params) {
        extract($params);

        $myComment = new Comment();
        $myComment  ->setIdComment(htmlspecialchars($_POST['idComment']))
                    ->setIdBillet(htmlspecialchars($_POST['idBillet']))
                    ->setReport(htmlspecialchars($_POST['report']));

        $commentManager = new CommentManager();
        $commentManager->flag($myComment);

        $currentView = new View();
        $currentView->redirect('admin-billet-page.html/number/' . $_POST['idBillet']);
    }

    
    public function deleteReportComment($params) {
        extract($params);
        $comManager = new CommentManager();
        $comManager->delete($id);
        // echo json_encode($comManager);
        $currentView = new View();
        $currentView->redirect('admin-home-page.html');
    }

    public function updateReportComment($params) {
        extract($params);
        $commentManager = new CommentManager();
        $myComment = $commentManager->read($id);
        $myComment->setStatus($status);
        $myComment->setReport($report);
        $myComment->setIdComment($id);

        $commentManager->save($myComment);
        echo json_encode(["status"=>$status, "report"=>$report, "idComment"=>$id]);
    }

    public function updateStatusComment($params) {
        extract($params);
        $commentManager = new CommentManager();
        $myComment = $commentManager->read($id);
        $myComment->setStatus($status);
        $myComment->setIdComment($id);

        $commentManager->save($myComment);
        echo json_encode(["status"=>$status, "idComment"=>$id]);
    }


    public function deleteComment($params) {
        extract($params);
        $commentManager = new CommentManager();
        $myComment = $commentManager->delete($id);
        echo json_encode($id);
    }


    public function deleteBillet($params) {
        extract($params);
        $billetManager = new BilletManager();
        $myBillet = $billetManager->delete($id);
        echo json_encode($id);
    }



    public function updateBillet($params) {
        extract($params);
        $billetManager = new BilletManager();
        $myBillet = $billetManager->read($number);
        $myBillet->setStatus($status);

        $billetManager->save($myBillet);
        echo json_encode(["status"=>$status]);
    }


    public function updateChangeBillet($params) {
        extract($params);
        $myBillet = new Billet();
        $myBillet->setTitle(htmlspecialchars($_POST['title']))
                ->setNumber(htmlspecialchars($_POST['number']))
                ->setContent(htmlspecialchars($_POST['content']))
                ->setId(htmlspecialchars($_POST['id']))
                ->setStatus(htmlspecialchars($_POST['status']));

        $billetManager = new BilletManager();
        $billetManager->update($myBillet);

        $currentView = new View();
        $currentView->redirect('change-billet.html/number/'. $_POST['number']);
    }



    public function readUser($params) {
        extract($params);

        $myUser = new User();
        $myUser->setUsername(htmlspecialchars($_POST['username_connect']))
                ->setPassword(htmlspecialchars($_POST['password_connect']));

        $userManager = new UserManager();
        $result = $userManager->read($myUser);
        
        if($result===false) {
            $currentView = new View();
            $currentView->redirect('user-home-page.html');
        } else {
            $_SESSION['u_id'] = $result->getIdUser();
            $_SESSION['username'] = $result->getUsername();
            $_SESSION['role'] = $result->getRole();

            $currentView = new View();
            $currentView->redirect('admin-home-page.html');
        }
    }


    public function deconnexionUser($params) {
        unset($_SESSION['u_id']);

        session_destroy();

        $currentView = new View();
        $currentView->redirect('user-home-page.html');
    }
}