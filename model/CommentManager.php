<?php
class CommentManager {

    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost; dbname=blog', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }

    public function create($comment) {
        $pdo = $this->pdo;
        $request = $pdo->prepare('
            INSERT INTO comment (c_id_billet, c_pseudo, c_comment, c_comment_date, c_status, c_report)
            VALUES (:c_id_billet, :c_pseudo, :c_comment, NOW(), :c_status, :c_report)
        ');
    
        //Liaison des paramètres
        $request->bindValue(':c_id_billet', $comment->getIdBillet(), PDO::PARAM_INT);
        $request->bindValue(':c_pseudo', $comment->getPseudo(), PDO::PARAM_STR);
        $request->bindValue(':c_comment', $comment->getComment(), PDO::PARAM_STR);
        $request->bindValue(':c_status', $comment->getStatus(), PDO::PARAM_STR);
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


    public function read($id) {
        $pdo = $this->pdo;
        $request = $pdo->prepare('SELECT * FROM comment WHERE c_id = :c_id');
    
        //Liaison des paramètres
        $request->bindValue(':c_id', $id, PDO::PARAM_INT);
        //exécution de la requête
        $request->execute();
        $row = $request->fetch(PDO::FETCH_ASSOC);

        $comment = new Comment();
        $comment->setIdComment($row['c_id']);
        $comment->setIdBillet($row['c_id_billet']);
        $comment->setPseudo($row['c_pseudo']);
        $comment->setComment($row['c_comment']);
        $comment->setCommentDate($row['c_comment_date']);
        $comment->setAnswer($row['c_answer']);
        // var_dump($comment); exit;
        return $comment;


    }


    public function readAll($idBillet) {
        $pdo = $this->pdo;
        $request = $pdo->prepare('
            SELECT c_id, c_id_billet, c_pseudo, c_comment, c_comment_date, c_status, c_report, c_answer
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
            $comment = $this->hydrate($row);
            $comments[] = $comment;
        };
        if(isset($comments)) {
            return $comments;
        }
    }

    public function hydrate($row) {
        $comment = new Comment();
        $comment->setIdComment($row['c_id']);
        $comment->setIdBillet($row['c_id_billet']);
        $comment->setPseudo($row['c_pseudo']);
        $comment->setComment($row['c_comment']);
        $comment->setCommentDate($row['c_comment_date']);
        $comment->setStatus($row['c_status']);
        $comment->setReport($row['c_report']);
        $comment->setAnswer($row['c_answer']);
        return $comment;
    }


    public function readAllReport() { 
        $pdo = $this->pdo;
        $request = $pdo->prepare('
            SELECT *
            FROM comment
            WHERE c_report = "on"
            ORDER BY c_comment_date DESC
        ');
        
        //exécution de la requête
        $request->execute();
        while ($row = $request->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->setIdComment($row['c_id']);
            $comment->setIdBillet($row['c_id_billet']);
            $comment->setPseudo($row['c_pseudo']);
            $comment->setComment($row['c_comment']);
            $comment->setCommentDate($row['c_comment_date']);
            $comment->setStatus($row['c_status']);
            $comment->setReport($row['c_report']);
            $comment->setAnswer($row['c_answer']);
            $comments[] = $comment;
        };
        if(isset($comments)) {
            return $comments;
        }
    }


    public function readAllNonRead() { 
        $pdo = $this->pdo;
        $request = $pdo->prepare('
            SELECT *
            FROM comment
            WHERE c_status = "non lu"
            ORDER BY c_comment_date DESC
        ');
        
        //exécution de la requête
        $request->execute();
        while ($row = $request->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->setIdComment($row['c_id']);
            $comment->setIdBillet($row['c_id_billet']);
            $comment->setPseudo($row['c_pseudo']);
            $comment->setComment($row['c_comment']);
            $comment->setCommentDate($row['c_comment_date']);
            $comment->setStatus($row['c_status']);
            $comment->setReport($row['c_report']);
            $comment->setAnswer($row['c_answer']);
            $comments[] = $comment;
        };
        if(isset($comments)) {
            return $comments;
        }
    }



    public function update($comment) { 
        //Préparation de la requête
        $pdo = $this->pdo;
        $request = $pdo->prepare('
            UPDATE comment
            set c_comment=:c_comment, c_status=:c_status, c_report=:c_report, c_answer=:c_answer
            WHERE c_id=:c_id 
            LIMIT 1
        ');

        //Liaison des paramètres
        $request->bindValue(':c_id', $comment->getIdComment(), PDO::PARAM_INT);
        $request->bindValue(':c_comment', $comment->getComment(), PDO::PARAM_STR);
        $request->bindValue(':c_status', $comment->getStatus(), PDO::PARAM_STR);
        $request->bindValue(':c_report', $comment->getReport(), PDO::PARAM_STR);
        $request->bindValue(':c_answer', $comment->getAnswer(), PDO::PARAM_STR);


        //Exécution de la requête
        $request->execute();
    }


    public function flag($comment) {
        $pdo = $this->pdo;
        $request = $pdo->prepare('
            UPDATE comment
            SET c_report=:c_report
            WHERE c_id=:c_id
        ');

        //Liaison des paramètres
        $request->bindValue(':c_id', $comment->getIdComment(), PDO::PARAM_INT);
        $request->bindValue(':c_report', $comment->getReport(), PDO::PARAM_STR);
        
        $request->execute();
    }


    public function answer($comment) {
        $pdo = $this->pdo;
        $request = $pdo->prepare('
            UPDATE comment
            SET c_answer=:c_answer, c_status=:c_status, c_report=:c_report
            WHERE c_id=:c_id
            LIMIT 1
        ');

        //Liaison des paramètres
        $request->bindValue(':c_id', $comment->getIdComment(), PDO::PARAM_INT);
        $request->bindValue(':c_answer', $comment->getAnswer(), PDO::PARAM_STR);
        $request->bindValue(':c_status', $comment->getStatus(), PDO::PARAM_STR);
        $request->bindValue(':c_report', $comment->getReport(), PDO::PARAM_STR);
        $request->execute();
    }



    public function nonRead($comment) {
        $pdo = $this->pdo;
        $request = $pdo->prepare('
            UPDATE comment
            SET c_status=:c_status
            WHERE c_id=:c_id
                AND c_id_billet=:c_id_billet
            LIMIT 1
        ');

        //Liaison des paramètres
        $request->bindValue(':c_id', $comment->getIdComment(), PDO::PARAM_INT);
        $request->bindValue(':c_id_billet', $comment->getIdBillet(), PDO::PARAM_INT);
        $request->bindValue(':c_status', $comment->getStatus(), PDO::PARAM_STR);
        
        $request->execute();
    }


    public function delete($comment) {
        $pdo = $this->pdo;
        $request = $pdo->prepare('DELETE FROM comment WHERE c_id=:c_id LIMIT 1');

        //Liaison des paramètres
        $request->bindValue(':c_id', $comment, PDO::PARAM_INT);

        //Ecécution de la requête
        $result=$request->execute();

    }


    public function save($comment) {
        if(is_null($comment->getIdComment())) {//si je récupère l'ID de l'user et que celui-ci est null (= n'existe pas)
            return $this->create($comment);
        } else {
            return $this->update($comment);
        }
    }
}
