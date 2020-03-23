<?php
class UserManager {

    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost; dbname=blog', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }

    public function create(User &$user) {
        //insère un objet user dans la base de donnée
        //met à jour l'objet passé en argument en lui spécifaint un id
        //prend en param User $user objet de type user passé par référence (&) (cad alias)
        //return bool true si l'objet a été inséré, false si une erreur est survenue
        $pdo = $this->pdo;
        $request = $pdo->prepare('INSERT INTO user (username, password, creation_date) VALUES (:username, :password, NOW())');
    
        //Liaison des paramètres
        $request->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
        $request->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT), PDO::PARAM_STR);

        //Exécution de la requête
          $executeIsOk = $request->execute();
        if ($executeIsOk) {
            $id = $pdo->lastInsertId();//retourne l'identifiant de la dernière ligne insérée
            $user = $this->read($user);//je récupère l'objet user auquel est affecté l'identifiant
            return true;
        } else {
            return false;
        }
    }

    public function read(User $user) {
        //récupère un objet user à partir de son pseudo
        //param pseudo str
        //return bool false si erreur et objet user si correspondance

        $pdo = $this->pdo;

        $request = $pdo->prepare('SELECT * FROM user WHERE username = :username');
    
        //Liaison des paramètres
        $request->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
        
        //exécution de la requête
        $executeIsOk = $request->execute();

        if($executeIsOk) {
            // $user = $this->pdoStatement->fetchObject('user');
            //je vais chercher le mdp de la bdd
            $row = $request->fetch(PDO::FETCH_ASSOC);
    
            //je vérifie les mots de passe
            if(password_verify($user->getPassword(), $row['password'])) {
                $user = new User();
                $user->setIdUser($row['u_id']);
                $user->setUsername($row['username']);
                $user->setPassword($row['password']);
                $user->setCreationDate($row['creation_date']);
    
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function readAll() {
        $pdo = $this->pdo;

        $request = $pdo->prepare('SELECT * FROM user');
    
        //exécution de la requête
        $executeIsOk = $request->execute();
        $allUsers = $request->fetchAll();
    }


    public function update($user) {
        //met à jour un objet stocké en bdd
        //parma User $user
        //return bool true succès ou false échec
        
        //Préparation de la requête
        $pdo = $this->pdo;

        $request = $pdo->prepare('UPDATE user set username=:username, password=:password WHERE u_id=:u_id LIMIT 1');

        //Liaison des paramètres
        $request->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
        $request->bindValue(':mdp', password_hash($user->getMdp(), PASSWORD_DEFAULT), PDO::PARAM_STR);
        $request->bindValue(':u_id', $user->getIdUser(), PDO::PARAM_INT);
        $request->bindValue(':date_creation', $user->getCreationdate(), PDO::PARAM_STR);

        //Exécution de la requête
        /**$executeIsOk =*/$request->execute();
        // if($executeIsOk) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function delete($user) {
        //supprime un objet stocké en bdd
        //param User $user
        //return bool true succès false echec

        //Préparation de la requête
        $pdo = $this->pdo;

        $request = $pdo->prepare('DELETE FROM user WHERE u_id=:u_id LIMIT 1');

        //Liaison des paramètres
        $request->bindValue(':u_id', $user->getIdUser(), PDO::PARAM_INT);

        //Ecécution de la requête
        /*$executeIsOk = */$request->execute();
        // if($executeIsOk) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function save($user) {
        if(is_null($user->getIdUser())) {//si je récupère l'ID de l'user et que celui-ci est null (= n'existe pas)
            return $this->create($user);
        } else {
            return $this->update($user);
        }
    }
}
