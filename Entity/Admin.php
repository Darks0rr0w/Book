<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/SnC/app/DBConnection.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/SnC/Entity/Entry.php');

class Admin
{
    public function login()
    {
        setcookie("admin", true,0);
    }
    public static function logout()
    {
        setcookie("admin", false);
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
        $conn = DBConnection::connect();
        $login = "admin";
        $password = password_hash("admin", PASSWORD_BCRYPT);
        $sql = "INSERT INTO admin (login, password) VALUES (:login, :password)";
        $q = $conn->prepare($sql);
        $q->bindParam(':login', $login, PDO::PARAM_STR);
        $q->bindParam(':password', $password, PDO::PARAM_STR);
        $q->execute();
        DBConnection::disconnect();
    }

    public function verifyAdmin($login, $password)
    {
        $conn = DBConnection::connect();
        $sql = "SElECT password FROM admin WHERE login = :login";
        $q= $conn->prepare($sql);
        $q->bindParam(':login', $login, PDO::PARAM_STR);
        $q->execute();

        $result = $q->fetch(PDO::FETCH_ASSOC);
        $hash = $result['password'];
        DBConnection::disconnect();

        return  password_verify($password, $hash) ? true : false;

    }

}