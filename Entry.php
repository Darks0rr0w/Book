<?php
/**
 * Created by PhpStorm.
 * User: z1m
 * Date: 01.07.2015
 * Time: 19:41
 */
require_once('admin/Admin.php');
require_once('DBConnection.php');


class Entry
{
    public $content;
    public $date;
    public $status;
    public function save()
    {
        $conn = DBConnection::connect();

        $content = $this->content;

            if (!empty($content)) {
                $sql = "INSERT INTO entry (content) VALUES (:content)";
                $q = $conn->prepare($sql);
                $q->bindParam(':content', $content, PDO::PARAM_STR);
                $q->execute();
            }
        DBConnection::disconnect();
    }


    public static function find($id)
    {
        $conn = DBConnection::connect();
        $sql = "SELECT * FROM entry WHERE id = ':id'";
        $q = $conn->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();

        $result = $q->fetch();
        DBConnection::disconnect();
        return $result;
    }

    public static function count()
    {
        $conn  =  DBConnection::connect();

        $result = $conn->query('SELECT COUNT(*) FROM entry')
            ->fetchColumn();
        return $result;
    }

    public static function findAll($limit, $offset)
    {
        $conn  =  DBConnection::connect();

        $sql = 'SELECT * FROM entry ORDER BY date LIMIT :limit OFFSET :offset';
        $q = $conn->prepare($sql);

        $q->bindParam(':limit', $limit, PDO::PARAM_INT);
        $q->bindParam(':offset', $offset, PDO::PARAM_INT);
        $q->execute();
        return $q;
    }



    public static function delete($id)
    {
        $conn = DBConnection::connect();
        $sql = "DELETE FROM entry WHERE id = :id";
        $q = $conn->prepare($sql);
        $q->bindParam('id', $id, PDO::PARAM_INT);
        $q->execute();
        DBConnection::disconnect();

    }

    public  function update($id)
    {

        $conn = DBConnection::connect();

        $status = $this->status;

        $sql = "UPDATE entry SET status = :status  WHERE id = :id";
        $q = $conn->prepare($sql);
        $q->bindParam('id',$id, PDO::PARAM_INT);
        $q->bindParam('status', $status, PDO::PARAM_INT);
        $q->execute();


    }
}