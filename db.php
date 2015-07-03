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

        $sql = "INSERT INTO entry (content,date,status) VALUES (".$this->content.","
                                                                .$this->date.","
                                                                .$this->status.")";
        $q = $this->dbh->prepare($sql);
       /* $q->execute([":{$this->content}" => $this->content,
                     ":{$this->date}" => $this->date,
                     ":{$this->status}" => $this->status]);*/
        $q->execute();
    }

    /*public function insert($values)
    {
        $sql = "INSERT INTO entry (content, date) VALUES (:{$values[0]},:{$values[1]})";
        $q = $this->dbh->prepare($sql);
        $q->execute([":{$values[0]}" => $values[0],
                     ":{$values[1]}" => $values[1]]);
    }*/

    public  function find($id)
    {
        //   TODO
        $sql = "SELECT * FROM entry WHERE id =".$id;
        $q = $this->dbh->prepare($sql);
        $q->execute();

    }

    public function close()
    {
        $this->dbh = null;
    }
}