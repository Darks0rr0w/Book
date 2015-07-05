<?php
/**
 * Created by PhpStorm.
 * User: z1m
 * Date: 01.07.2015
 * Time: 19:41
 */

require_once('DataBase.php');

class Entry extends DataBase
{
    private $content;
    private $status;
    private $date;

     function __construct()
     {
         $this->dbh = new PDO('mysql:host=localhost;dbname=Book', $this->user, $this->password);
     }

    public function save()
    {
        $this->content = mysql_real_escape_string($this->content);
        $sql = "INSERT INTO entry (content,date,status) VALUES (':content', ':date', ':status')";
        $q = $this->dbh->prepare($sql);
        $q->bindParam(':content', $this->content );
        $q->bindParam(':date', $this->date);
        $q->bindParam(':status', $this->status);
        $q->execute();
    }


    public  function find($id)
    {
        $sql = "SELECT * FROM entry WHERE id = ':id'";
        $q = $this->dbh->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();

        $result = $q->fetch();
        return $result;
    }

    public function findAll()
    {
        $sql = "SELECT * FROM entry";
        $q = $this->dbh->prepare($sql);
        $q->execute();

        $result = $q->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function close()
    {
        $this->dbh = null;
    }
}