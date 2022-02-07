<?php

require_once 'Repository.php';

require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository
{
    private function getUserData( $con, int $id) :?User{
        // natural join public.accountTypes aT on uD.accountTypeId = aT.id
        //     $stmt = $this->database->connect()->prepare(
        $stmt = $con->prepare('SELECT * FROM usersdata NATURAL JOIN users NATURAL JOIN account_types WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt == null){
            //todo log dla administratora
            return null;
        }

         $user = new User(
            $result['login'],
            $result['password'],
            $result['username'],
            $result['email'],
            $result['accountType']
        );

        return $user;
    }

    public function getUser( string $login, string $password): ?User
    {
        $pass = md5($password);
        $con = $this->database->setConnection();
        $stmt = $con->prepare('SELECT id FROM public.users WHERE login = :login AND password = :password');
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->bindParam(':password', $pass, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN);


        if ($stmt->rowCount() != 1) {            return null;        }

        $id = $result[0];

        return $this->getUserData($con, $id);

    }



    public function register($user){
        $con = $this->database->setConnection();

        $stmt = $con->prepare("INSERT INTO users VALUES (DEFAULT, :login, :password) returning id");
        $stmt->bindParam(':login', $user->getLogin(), PDO::PARAM_STR);
        $stmt->bindParam(':password', $user->getPassword(), PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $con->prepare("INSERT INTO usersdata VALUES ( :id , :username, :email, 2, now())");
        $stmt->bindParam(':id', $result['id'], PDO::PARAM_INT);
        $stmt->bindParam(':username', $user->getUsername(), PDO::PARAM_STR);
        $stmt->bindParam(':username', $user->getUsername(), PDO::PARAM_STR);
        $stmt->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->execute();


        return $user;
    }


    public function isLoginAvailable($login){

        $con = $this->database->setConnection();
        $stmt = $con->prepare('SELECT count(*) FROM users WHERE login LIKE :login ');
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function isEmailAvailable($email){
        $con = $this->database->setConnection();
        $stmt = $con->prepare('SELECT count(*)  FROM usersdata WHERE email LIKE :email ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



}