<?php
class CommentManager {

    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost; dbname=blog', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }

    public function create($comment) {
        //insère un objet user dans la base de donnée
        //met à jour l'objet passé en argument en lui spécifaint un id
        //prend en param User $user objet de type user passé par référence (&) (cad alias)
        //return bool true si l'objet a été inséré, false si une erreur est survenue
        $pdo = $this->pdo;
        $request = $pdo->prepare('
            INSERT INTO comment (c_id_billet, c_comment, c_comment_date, c_report)
            VALUES (:c_id_billet, :c_comment, NOW(), :c_report)
        ');
    
        //Liaison des paramètres
        $request->bindValue(':c_id_billet', $comment->getIdBillet(), PDO::PARAM_INT);
        $request->bindValue(':c_comment', $comment->getComment(), PDO::PARAM_STR);
        $request->bindValue(':c_report', $comment->getReport(), PDO::PARAM_STR);

        //Exécution de la requête
          $executeIsOk = $request->execute();
        if ($executeIsOk) {
            $idComment = $pdo->lastInsertId();//retourne l'identifiant de la dernière ligne insérée
            $comment = $this->read($comment);//je récupère l'objet comment auquel est affecté l'identifiant
            return true;
        } else {
            return false;
        }
    }

    // public function read(Comment $comment) {
    //     //récupère un objet user à partir de son pseudo
    //     //param pseudo str
    //     //return bool false si erreur et objet user si correspondance

    //     $pdo = $this->pdo;

    //     $request = $pdo->prepare('SELECT * FROM comment WHERE number = :number');
    
    //     //Liaison des paramètres
    //     $request->bindValue(':comment', $comment->getComment(), PDO::STR);

    //     //exécution de la requête
    //     $request->execute();
    // }

    public function read($comment) {
        //récupère un objet user à partir de son pseudo
        //param pseudo str
        //return bool false si erreur et objet user si correspondance

        $pdo = $this->pdo;

        $request = $pdo->prepare('SELECT * FROM comment WHERE c_id = :c_id');
    
        //Liaison des paramètres
        $request->bindValue(':c_id', $comment->getIdComment(), PDO::PARAM_INT);

        //exécution de la requête
        $request->execute();
        $row = $request->fetch(PDO::FETCH_ASSOC);
        
        $comment = new Comment();
        $comment->setIdComment($row['c_id']);
        $comment->setIdBillet($row['c_id_billet']);
        $comment->setComment($row['c_comment']);
        $comment->setCommentDate($row['c_comment_date']);

        if(isset($comment)) {
            return $comment;
        }

    }



    public function readAll($idBillet) {
        $pdo = $this->pdo;

        $request = $pdo->prepare('
            SELECT c_id, c_id_billet, c_comment, c_comment_date
            FROM comment
            INNER JOIN billet 
                ON comment.c_id_billet = billet.b_id
            WHERE c_id_billet=:c_id_billet
            ORDER BY c_comment_date DESC
        ');
        
        $request->bindValue(':c_id_billet', $idBillet, PDO::PARAM_INT);

        //exécution de la requête
        $request->execute();
        while ($row = $request->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->setIdComment($row['c_id']);
            $comment->setIdBillet($row['c_id_billet']);
            $comment->setComment($row['c_comment']);
            $comment->setCommentDate($row['c_comment_date']);
            $comments[] = $comment;
        };
        if(isset($comments)) {
            return $comments;
        }
    }

    public function readAllReport() {
        $pdo = $this->pdo;

        $request = $pdo->prepare('
            SELECT *
            FROM comment
            WHERE c_report = "on"
            ORDER BY c_comment_date DESC
        ');
        
        //  $request->bindValue('report', $comment->getReport(), PDO::PARAM_BOOL);
        //   $request->bindValue(':report', $report, PDO::PARAM_BOOL);

        //exécution de la requête
        $request->execute();
        while ($row = $request->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->setIdComment($row['c_id']);
            $comment->setIdBillet($row['c_id_billet']);
            $comment->setComment($row['c_comment']);
            $comment->setCommentDate($row['c_comment_date']);
            $comment->setReport($row['c_report']);
            $comments[] = $comment;
        };
        if(isset($comments)) {
            return $comments;
        }
    }



    public function update($comment) {
        //met à jour un objet stocké en bdd
        //parma User $user
        //return bool true succès ou false échec
        
        //Préparation de la requête
        $pdo = $this->pdo;

        $request = $pdo->prepare('UPDATE comment set c_report=:c_report WHERE c_id=:c_id LIMIT 1');

        //Liaison des paramètres
        // $request->bindValue(':comment', $comment->getComment(), PDO::PARAM_STR);
        $request->bindValue(':c_id', $comment->getIdComment(), PDO::PARAM_INT);
        // $request->bindValue(':id_billet', $comment->getIdBillet(), PDO::PARAM_INT);
        // $request->bindValue(':comment_date', $comment->getCommentDate(), PDO::PARAM_STR);
        $request->bindValue(':c_report', $comment->getReport(), PDO::PARAM_BOOL);
        //Exécution de la requête
        /**$executeIsOk =*/$request->execute();
        // if($executeIsOk) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function flag($comment) {
        //met à jour un objet stocké en bdd
        //parma User $user
        //return bool true succès ou false échec
        
        //Préparation de la requête
        $pdo = $this->pdo;

        $request = $pdo->prepare('UPDATE comment SET c_report=:c_report WHERE c_id=:c_id AND c_id_billet=:c_id_billet LIMIT 1');

        //Liaison des paramètres
        // $request->bindValue(':comment', $comment->getComment(), PDO::PARAM_STR);
        $request->bindValue(':c_id', $comment->getIdComment(), PDO::PARAM_INT);
        $request->bindValue(':c_id_billet', $comment->getIdBillet(), PDO::PARAM_INT);
        // $request->bindValue(':comment_date', $comment->getCommentDate(), PDO::PARAM_STR);
        $request->bindValue(':c_report', $comment->getReport(), PDO::PARAM_STR);
// var_dump($comment->getIdComment()); exit;
        //Exécution de la requête
        /**$executeIsOk =*/$request->execute();
        // if($executeIsOk) {
        //     return true;
        // } else {
        //     return false;
        // }
    }


    public function delete($comment) {
        //supprime un objet stocké en bdd
        //param User $user
        //return bool true succès false echec

        //Préparation de la requête
        $pdo = $this->pdo;

        $request = $pdo->prepare('DELETE FROM comment WHERE c_id=:c_id LIMIT 1');

        //Liaison des paramètres
        $request->bindValue(':c_id', $comment->getIdComment(), PDO::PARAM_INT);

        //Ecécution de la requête
        /*$executeIsOk = */$request->execute();
        // if($executeIsOk) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function save($comment) {
        if(is_null($comment->getIdComment())) {//si je récupère l'ID de l'user et que celui-ci est null (= n'existe pas)
            return $this->create($comment);
        } else {
            return $this->update($comment);
        }
    }
}
