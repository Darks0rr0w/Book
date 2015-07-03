<?php
/**
 * Created by PhpStorm.
 * User: z1m
 * Date: 02.07.2015
 * Time: 7:44
 */

class DataBase
{
    protected $user = "root";
    protected $password = "";

    protected $dbh;

    function __construct()
    {
        $this->dbh = new PDO('mysql:host=localhost;dbname=Book', $this->user, $this->password);
    }
}