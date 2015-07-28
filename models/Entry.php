<?php
/**
 * Created by PhpStorm.
 * User: z1m
 * Date: 01.07.2015
 * Time: 19:41
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/SnC/admin/Admin.php');
require_once($_SERVER['DOCUMENT_ROOT'] .'/SnC/app/DBConnection.php');


class Entry
{
    private $content;

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
    private $date;

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
    private $status;


    public function save()
    {
        $conn = DBConnection::connect();

        $content = $this->content;
        $date = date('Y-m-d H:i:s');

            if (!empty($content)) {
                $sql = "INSERT INTO entry (content, date) VALUES (:content, :date)";
                $q = $conn->prepare($sql);
                $q->bindParam(':content', $content, PDO::PARAM_STR);
                $q->bindParam(':date', $date, PDO::PARAM_STR);
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