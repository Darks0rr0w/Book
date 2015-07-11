<?php
require_once('DataBase.php');
require_once('Entry.php');

class Admin extends DataBase
{
    public function login()
    {
        setcookie("admin", true);
    }
    public static function logout()
    {
        setcookie("admin", null);
    }
    public static function isAdmin()
    {
        if (@$_COOKIE['admin'] == true) {
            return true;
        } else {
            return false;
        }
    }



    public function registerAdmin()
    {
        $login = "admin";
        $password = password_hash("admin", PASSWORD_BCRYPT);
        $sql = "INSERT INTO admin (login, password) VALUES (:login, :password)";
        $q = $this->dbh->prepare($sql);
        $q->bindParam(':login', $login, PDO::PARAM_STR);
        $q->bindParam(':password', $password, PDO::PARAM_STR);
        $q->execute();
    }

    public function verifyAdmin($login, $password)
    {


        $sql = "SElECT password FROM admin WHERE login = :login";
        $q= $this->dbh->prepare($sql);
        $q->bindParam(':login', $login, PDO::PARAM_STR);
        $q->execute();

        $result = $q->fetch(PDO::FETCH_ASSOC);
        $hash = $result['password'];

        return  password_verify($password, $hash) ? true : false;
    }

}