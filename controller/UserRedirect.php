<?php

class UserRedirect {

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


    public function createComment($params) {
        extract($params);
        $myComment = new Comment();
        $myComment  ->setPseudo($_POST['pseudo'])
                    ->setComment($_POST['message'])
                    ->setIdBillet($_POST['billet'])
                    ->setStatus($_POST['status'])
                    ->setReport($_POST['report'])
                    ->setCommentDate($_POST['commentDate']);


        $commentManager = new CommentManager();
        $commentManager->create($myComment);

        $currentView = new View();
        $currentView->redirect('user-billet-page.html/id/' . $_POST['billet']);
    }

    public function reportComment($params) {
        extract($params);

        $commentManager = new CommentManager();

        $myComment = $commentManager->read($id); // récupréer l'objet comment

        $myComment->setReport($report);

        $commentManager->save($myComment);


        // retrun Json si ajax
        $currentView = new View();
        $currentView->redirect('user-billet-page.html/id/' . $_POST['idBillet']);
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