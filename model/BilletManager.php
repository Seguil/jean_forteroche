<?php
class BilletManager {

    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost; dbname=blog', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }

    public function create(Billet &$billet) {
        //insère un objet user dans la base de donnée
        //met à jour l'objet passé en argument en lui spécifaint un id
        //prend en param User $user objet de type user passé par référence (&) (cad alias)
        //return bool true si l'objet a été inséré, false si une erreur est survenue
        $pdo = $this->pdo;
        $request = $pdo->prepare('INSERT INTO billet (b_number, b_title, b_content, b_publication_date, b_status) VALUES (:b_number, :b_title, :b_content, NOW(), :b_status)');
    
        //Liaison des paramètres
        $request->bindValue(':b_number', $billet->getNumber(), PDO::PARAM_INT);
        $request->bindValue(':b_title', $billet->getTitle(), PDO::PARAM_STR);
        $request->bindValue(':b_content', $billet->getContent(), PDO::PARAM_STR);
        $request->bindValue(':b_status', $billet->getStatus(), PDO::PARAM_STR);

        //Exécution de la requête
        $executeIsOk = $request->execute();
        if ($executeIsOk) {
            $id = $pdo->lastInsertId();//retourne l'identifiant de la dernière ligne insérée
            $billet = $this->read($billet);//je récupère l'objet user auquel est affecté l'identifiant
            return true;
        } else {
            return false;
        }
    }

    public function read($id) {
        //récupère un objet user à partir de son pseudo
        //param pseudo str
        //return bool false si erreur et objet user si correspondance

        $pdo = $this->pdo;

        $request = $pdo->prepare('SELECT * FROM billet WHERE b_id = :b_id');
    
        //Liaison des paramètres
        $request->bindValue(':b_id', $id, PDO::PARAM_INT);

        //exécution de la requête
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

        // $billetsParPage = 5;
        $billetsTotalReq = $pdo->query('SELECT b_id FROM billet');
        $billetsTotal = $billetsTotalReq->rowCount();

        
        return $billetsTotal;

    }

    // public function readAll() {
    //     $pdo = $this->pdo;

    //     $request = $pdo->query('SELECT * FROM billet ORDER BY number DESC');

    //     $request->execute();
        
    //     while ($row = $request->fetch(PDO::FETCH_ASSOC)) {
    //         $billet = new Billet();
    //         $billet->setId($row['b_id']);
    //         $billet->setNumber($row['number']);
    //         $billet->setTitle($row['title']);
    //         $billet->setContent($row['content']);
    //         $billet->setPublicationDate($row['publication_date']);
    //         $billets[] = $billet;
    //     };
    //         return $billets;
    // }


    public function readAll($depart, $billetsParPage) {

        $pdo = $this->pdo;


        //Affichage des billets
        $request = $pdo->prepare('SELECT * FROM billet ORDER BY b_number DESC LIMIT '.$depart.','.$billetsParPage);
        // $request = $pdo->prepare('SELECT * FROM billet ORDER BY number DESC LIMIT 0,5');

        //exécution de la requête
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

        //Affichage des billets
        $request = $pdo->prepare('
            SELECT *
            FROM billet
            WHERE b_status = "non published"
            ORDER BY b_number
        ');

        //exécution de la requête
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
        //met à jour un objet stocké en bdd
        //parma User $user
        //return bool true succès ou false échec
        
        //Préparation de la requête
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

        //Liaison des paramètres
        $request->bindValue(':b_number', $billet->getNumber(), PDO::PARAM_INT);
        $request->bindValue(':b_title', $billet->getTitle(), PDO::PARAM_STR);
        $request->bindValue(':b_content', $billet->getContent(), PDO::PARAM_STR);
        $request->bindValue(':b_status', $billet->getStatus(), PDO::PARAM_STR);
        $request->bindValue(':b_id', $billet->getId(), PDO::PARAM_INT);


        //Exécution de la requête
        /**$executeIsOk =*/$request->execute();
        // if($executeIsOk) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function delete($billet) {
        //supprime un objet stocké en bdd
        //param User $user
        //return bool true succès false echec

        //Préparation de la requête
        $pdo = $this->pdo;

        $request = $pdo->prepare('DELETE FROM billet WHERE b_id=:b_id LIMIT 1');

        //Liaison des paramètres
        $request->bindValue(':b_id', $billet, PDO::PARAM_INT);

        //Ecécution de la requête
        /*$executeIsOk = */$request->execute();
        // if($executeIsOk) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function save($billet) {
        if(is_null($billet->getId())) {//si je récupère l'ID de l'user et que celui-ci est null (= n'existe pas)
            return $this->create($billet);
        } else {
            return $this->update($billet);
        }
    }
}
