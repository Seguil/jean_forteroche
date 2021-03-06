<?php

class UserRedirect {

    public function selectBillet($params) {
        extract($params);

        $billetManager = new BilletManager();
        $myBillet = $billetManager->read($id);
        
        $number = $myBillet->getNumber();
        $title = $myBillet->getTitle();
        $content = $myBillet->getContent();
        $publicationDate = $myBillet->getPublicationDate();
        echo json_encode(["number"=>$number, "title"=>$title, "content"=>$content, "publication_date"=>$publicationDate]);
    }

    
    public function createUser($params) {
        extract($params);
        
        $myUser = new User();
        $myUser->setUsername(htmlspecialchars($_POST['username']))
             ->setPassword(htmlspecialchars($_POST['password']));

        $userManager = new UserManager();
        $userManager->create($myUser);

        $currentView = new View();
        $currentView->redirect('admin/admin-home-page.html');
    }


    public function createComment($params) {
        extract($params);
            $myComment = new Comment();
            $myComment  ->setPseudo(htmlspecialchars($_POST['pseudo']))
                        ->setComment(htmlspecialchars($_POST['message']))
                        ->setIdBillet($_POST['billet'])
                        ->setStatus($_POST['status'])
                        ->setReport($_POST['report'])
                        ->setCommentDate($_POST['commentDate']);

            $commentManager = new CommentManager();
            $commentManager->create($myComment);

        $currentView = new View();
        $currentView->redirect('user-billet-page.html/number/' . $_POST['billet']);
    }

    public function reportComment($params) {
        extract($params);

        $commentManager = new CommentManager();

        $myComment = $commentManager->read($id); // récupréer l'objet comment

        $myComment->setReport($report);

        $commentManager->save($myComment);


        echo json_encode(["report"=>$report]);
    }

}