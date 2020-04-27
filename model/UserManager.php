<?php
class UserManager {

    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost; dbname=blog', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }

    public function create(User &$user) {
        $pdo = $this->pdo;
        $request = $pdo->prepare('INSERT INTO user (u_username, u_password, u_role, u_creation_date) VALUES (:u_username, :u_password, :u_role,  NOW())');
    
        $request->bindValue(':u_username', $user->getUsername(), PDO::PARAM_STR);
        $request->bindValue(':u_password', password_hash($user->getPassword(), PASSWORD_DEFAULT), PDO::PARAM_STR);
        $request->bindValue(':u_role', $user->getRole(), PDO::PARAM_STR);

        $executeIsOk = $request->execute();
        if ($executeIsOk) {
            $id = $pdo->lastInsertId();
            $user = $this->read($user);
            return true;
        } else {
            return false;
        }
    }

    public function read(User $user) {
        $pdo = $this->pdo;

        $request = $pdo->prepare('SELECT * FROM user WHERE u_username = :u_username');
    
        $request->bindValue(':u_username', $user->getUsername(), PDO::PARAM_STR);
        
        $executeIsOk = $request->execute();

        if($executeIsOk) {
            $row = $request->fetch(PDO::FETCH_ASSOC);
    
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
    
        $executeIsOk = $request->execute();
        $allUsers = $request->fetchAll();
    }


    public function update($user) {
        $pdo = $this->pdo;

        $request = $pdo->prepare('UPDATE user set u_username=:u_username, u_password=:u_password WHERE u_id=:u_id LIMIT 1');

        $request->bindValue(':u_username', $user->getUsername(), PDO::PARAM_STR);
        $request->bindValue(':u_mdp', password_hash($user->getMdp(), PASSWORD_DEFAULT), PDO::PARAM_STR);
        $request->bindValue(':u_id', $user->getIdUser(), PDO::PARAM_INT);
        $request->bindValue(':u_role', $user->getRole(), PDO::PARAM_STR);
        $request->bindValue(':u_date_creation', $user->getCreationdate(), PDO::PARAM_STR);

        $request->execute();
    }


    public function delete($user) {
        $pdo = $this->pdo;

        $request = $pdo->prepare('DELETE FROM user WHERE u_id=:u_id LIMIT 1');

        $request->bindValue(':u_id', $user->getIdUser(), PDO::PARAM_INT);

        $request->execute();
    }


    public function save($user) {
        if(is_null($user->getIdUser())) {
            return $this->create($user);
        } else {
            return $this->update($user);
        }
    }
}
