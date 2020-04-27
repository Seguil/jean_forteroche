<?php
class BilletManager {

    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost; dbname=blog', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }

    public function create(Billet &$billet) {
        $pdo = $this->pdo;
        $request = $pdo->prepare('INSERT INTO billet (b_number, b_title, b_content, b_publication_date, b_status) VALUES (:b_number, :b_title, :b_content, NOW(), :b_status)');
    
        $request->bindValue(':b_number', $billet->getNumber(), PDO::PARAM_INT);
        $request->bindValue(':b_title', $billet->getTitle(), PDO::PARAM_STR);
        $request->bindValue(':b_content', $billet->getContent(), PDO::PARAM_STR);
        $request->bindValue(':b_status', $billet->getStatus(), PDO::PARAM_STR);

        $executeIsOk = $request->execute();
        if ($executeIsOk) {
            $id = $pdo->lastInsertId();
            $billet = $this->read($billet);
            return true;
        } else {
            return false;
        }
    }


    public function read($number) {
        $pdo = $this->pdo;

        $request = $pdo->prepare('SELECT * FROM billet WHERE b_number = :b_number');
    
        $request->bindValue(':b_number', $number, PDO::PARAM_INT);

        $request->execute();
        $row = $request->fetch(PDO::FETCH_ASSOC);
        
        $billet = new Billet();
        $billet->setId($row['b_id']);
        $billet->setNumber($row['b_number']);
        $billet->setTitle($row['b_title']);
        $billet->setContent($row['b_content']);
        $billet->setPublicationDate($row['b_publication_date']);
        $billet->setStatus($row['b_status']);

        return $billet;
    }


    public function pagination() {
        $pdo = $this->pdo;

        $billetsTotalReq = $pdo->query('SELECT b_id FROM billet WHERE b_status = "published"');
        $billetsTotal = $billetsTotalReq->rowCount();
       
        return $billetsTotal;
    }


    public function readAll($depart, $billetsParPage) {
        $pdo = $this->pdo;

        $request = $pdo->prepare('
            SELECT *
            FROM billet
            WHERE b_status = "published"
            ORDER BY b_number
            DESC
            LIMIT '.$depart.','.$billetsParPage
        );

        $request->execute();
        while ($row = $request->fetch(PDO::FETCH_ASSOC)) {
            $billet = new Billet();
            $billet->setId($row['b_id']);
            $billet->setNumber($row['b_number']);
            $billet->setTitle($row['b_title']);
            $billet->setContent($row['b_content']);
            $billet->setPublicationDate($row['b_publication_date']);
            $billet->setStatus($row['b_status']);

            $billets[] = $billet;
        };

        return $billets;
    }


    public function readNonPublished() {
        $pdo = $this->pdo;

        $request = $pdo->prepare('
            SELECT *
            FROM billet
            WHERE b_status = "non published"
            ORDER BY b_number
        ');

        $request->execute();
        while ($row = $request->fetch(PDO::FETCH_ASSOC)) {
            $billet = new Billet();
            $billet->setId($row['b_id']);
            $billet->setNumber($row['b_number']);
            $billet->setTitle($row['b_title']);
            $billet->setContent($row['b_content']);
            $billet->setPublicationDate($row['b_publication_date']);
            $billet->setStatus($row['b_status']);
            $billets[] = $billet;
        };

        if(isset($billets)) {
            return $billets;
        }
    }


    public function update($billet) {
        $pdo = $this->pdo;

        $request = $pdo->prepare('
            UPDATE billet 
            set b_number=:b_number, 
                b_title=:b_title,
                b_content=:b_content,
                b_publication_date=NOW(),
                b_status=:b_status
            WHERE b_id=:b_id
            LIMIT 1
        ');

        $request->bindValue(':b_number', $billet->getNumber(), PDO::PARAM_INT);
        $request->bindValue(':b_title', $billet->getTitle(), PDO::PARAM_STR);
        $request->bindValue(':b_content', $billet->getContent(), PDO::PARAM_STR);
        $request->bindValue(':b_status', $billet->getStatus(), PDO::PARAM_STR);
        $request->bindValue(':b_id', $billet->getId(), PDO::PARAM_INT);
    }


    public function delete($billet) {
        $pdo = $this->pdo;

        $request = $pdo->prepare('DELETE FROM billet WHERE b_id=:b_id LIMIT 1');

        $request->bindValue(':b_id', $billet, PDO::PARAM_INT);

        $request->execute();
    }


    public function save($billet) {
        if(is_null($billet->getId())) {
            return $this->create($billet);
        } else {
            return $this->update($billet);
        }
    }
}
