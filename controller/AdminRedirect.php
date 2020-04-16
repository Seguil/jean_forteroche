<?php

class AdminRedirect {

    public function createBillet($params) {
        extract($params);

        $myBillet = new Billet();
        $myBillet->setNumber($_POST['number'])
                ->setTitle($_POST['title'])
                ->setContent($_POST['content'])
                ->setStatus($_POST['status']);


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
// var_dump($params); exit;
        // $myComment = $commentManager->read($id); // récupréer l'objet comment
        $myComment = new Comment();

        // $myComment  ->setAnswer($_POST['answer'])
        //             ->setReport($_POST['report'])
        //             ->setReport($_POST['idComment'])
        //             ->setStatus($_POST['status']);
        $myComment->setStatus($_POST['status']);
        $myComment->setReport($report);
        $myComment->setAnswer($answer);
        $myComment->setIdComment($id);
        $commentManager = new CommentManager();

        $commentManager->save($myComment);

            
        // $commentManager = new CommentManager();
        // $commentManager->save($myComment);

echo json_encode(["status"=>$status, "report"=>$report, "idComment"=>$id, "answer"=>$answer]);


        // $currentView = new View();
        // $currentView->redirect('admin-home-page.html');
    }


    public function updateReportComment($params) {
        extract($params);
        $commentManager = new CommentManager();
        $myComment = $commentManager->read($id); // récupréer l'objet comment
        $myComment->setStatus($status);
        $myComment->setReport($report);
        $myComment->setIdComment($id);

        $commentManager->save($myComment);
        // retrun Json si ajax
        echo json_encode(["status"=>$status, "report"=>$report, "idComment"=>$id]);
        // $currentView = new View();
        // $currentView->redirect('admin-home-page.html');
    }

    public function updateStatusComment($params) {
        extract($params);
        $commentManager = new CommentManager();
        $myComment = $commentManager->read($id); // récupréer l'objet comment
        $myComment->setStatus($status);
        $myComment->setIdComment($id);

        $commentManager->save($myComment);
        // retrun Json si ajax
        echo json_encode(["status"=>$status, "idComment"=>$id]);
        // $currentView = new View();
        // $currentView->redirect('admin-home-page.html');
    }


    public function deleteComment($params) {
        extract($params);
        $commentManager = new CommentManager();
        $myComment = $commentManager->delete($id);
        echo json_encode($id);
        // $currentView = new View();
        // $currentView->redirect('admin-home-page.html');
    }


    public function deleteBillet($params) {
        extract($params);
        $billetManager = new BilletManager();
        $myBillet = $billetManager->delete($id);
        echo json_encode($id);
        // $currentView = new View();
        // $currentView->redirect('admin-home-page.html');
    }



    public function updateBillet($params) {
        extract($params);
        $billetManager = new BilletManager();
        $myBillet = $billetManager->read($id); // récupréer l'objet comment
        $myBillet->setStatus($status);
        $myBillet->setId($id);

        $billetManager->save($myBillet);
        // retrun Json si ajax
        echo json_encode(["status"=>$status, "id"=>$id]);
        // $currentView = new View();
        // $currentView->redirect('admin-home-page.html');
    }


    public function updateChangeBillet($params) {
        extract($params);
        $myBillet = new Billet();
        $myBillet->setTitle($_POST['title'])
                ->setNumber($_POST['number'])
                ->setContent($_POST['content'])
                ->setId($_POST['id'])
                ->setStatus($_POST['status']);

        $billetManager = new BilletManager();
        $billetManager->update($myBillet); // récupréer l'objet comment

        // retrun Json si ajax
        // echo json_encode(["status"=>$status, "id"=>$id]);
        $currentView = new View();
        $currentView->redirect('change-billet.html/id/'.$_POST['id']);
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