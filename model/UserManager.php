<?php
class UserManager {

    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost; dbname=blog', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }

    public function create(User &$user) {
        $pdo = $this->pdo;
        $request = $pdo->prepare('INSERT INTO user (u_username, u_password, u_role, u_creation_date) VALUES (:u_username, :u_password, :u_role,  NOW())');
    
        //Liaison des paramètres
        $request->bindValue(':u_username', $user->getUsername(), PDO::PARAM_STR);
        $request->bindValue(':u_password', password_hash($user->getPassword(), PASSWORD_DEFAULT), PDO::PARAM_STR);
        $request->bindValue(':u_role', $user->getRole(), PDO::PARAM_STR);

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

        $pdo = $this->pdo;

        $request = $pdo->prepare('SELECT * FROM user WHERE u_username = :u_username');
    
        //Liaison des paramètres
        $request->bindValue(':u_username', $user->getUsername(), PDO::PARAM_STR);
        
        //exécution de la requête
        $executeIsOk = $request->execute();

        if($executeIsOk) {
            $row = $request->fetch(PDO::FETCH_ASSOC);
    
            //je vérifie les mots de passe
            if(password_verify($user->getPassword(), $row['u_password'])) {
                $user = new User();
                $user->setIdUser($row['u_id']);
                $user->setUsername($row['u_username']);
                $user->setPassword($row['u_password']);
                $user->setRole($row['u_role']);
                $user->setCreationDate($row['u_creation_date']);
    
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
        
        //Préparation de la requête
        $pdo = $this->pdo;

        $request = $pdo->prepare('UPDATE user set u_username=:u_username, u_password=:u_password WHERE u_id=:u_id LIMIT 1');

        //Liaison des paramètres
        $request->bindValue(':u_username', $user->getUsername(), PDO::PARAM_STR);
        $request->bindValue(':u_mdp', password_hash($user->getMdp(), PASSWORD_DEFAULT), PDO::PARAM_STR);
        $request->bindValue(':u_id', $user->getIdUser(), PDO::PARAM_INT);
        $request->bindValue(':u_role', $user->getRole(), PDO::PARAM_STR);
        $request->bindValue(':u_date_creation', $user->getCreationdate(), PDO::PARAM_STR);

        //Exécution de la requête
        $request->execute();
    }

    public function delete($user) {

        //Préparation de la requête
        $pdo = $this->pdo;

        $request = $pdo->prepare('DELETE FROM user WHERE u_id=:u_id LIMIT 1');

        //Liaison des paramètres
        $request->bindValue(':u_id', $user->getIdUser(), PDO::PARAM_INT);

        //Ecécution de la requête
        $request->execute();
     
    }

    public function save($user) {
        if(is_null($user->getIdUser())) {//si je récupère l'ID de l'user et que celui-ci est null (= n'existe pas)
            return $this->create($user);
        } else {
            return $this->update($user);
        }
    }
}
