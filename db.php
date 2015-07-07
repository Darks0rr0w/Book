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
        parent::__construct();
    }

    public function save()
    {
        $this->content = mysql_real_escape_string($this->content);
        $sql = "INSERT INTO entry (content,date,status) VALUES (':content', ':date', ':status')";
        $q = $this->dbh->prepare($sql);
        $q->bindParam(':content', $this->content);
        $q->bindParam(':date', $this->date);
        $q->bindParam(':status', $this->status);
        $q->execute();
    }


    public function find($id)
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
        //$sql = "SELECT * FROM entry";
        //$q = $this->dbh->prepare($sql);
        //$q->execute();

        //$result = $q->fetchAll(PDO::FETCH_ASSOC);

        //return $result;


        try {

            // Find out how many items are in the table
            $total = $this->dbh->query('SELECT COUNT(*) FROM entry')->fetchColumn();

            // How many items to list per page
            $limit = 20;

            // How many pages will there be
            $pages = ceil($total / $limit);

            // What page are we currently on?
            $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
                'options' => array(
                    'default'   => 1,
                    'min_range' => 1,
                ),
            )));

            // Calculate the offset for the query
            $offset = ($page - 1)  * $limit;

            // Some information to display to the user
            $start = $offset + 1;
            $end = min(($offset + $limit), $total);

            // The "back" link
            $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

            // The "forward" link
            $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

            // Display the paging information
            echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';

            // Prepare the paged query
            $stmt = $this->dbh->prepare('SELECT * FROM entry ORDER BY date LIMIT :limit OFFSET :offset');

            // Bind the query params
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            // Do we have any results?
            if ($stmt->rowCount() > 0) {
                // Define how we want to fetch the results
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $iterator = new IteratorIterator($stmt);

                // Display the results
                foreach ($iterator as $row) {
                    echo '<p>', $row['content'], '</p>';
                }

            } else {
                echo '<p>No results could be displayed.</p>';
            }

        } catch (Exception $e) {
            echo '<p>', $e->getMessage(), '</p>';
        }
    }

    public  function delete($id)
    {
        $sql = "DELETE FROM entry WHERE id = :id";
        $q = $this->dbh->prepare($sql);
        $q->bindParam('id', $id, PDO::PARAM_INT);
        $q->execute();
    }

    public function update($id)
    {
        $sql = "UPDATE entry SET status = 1 WHERE id = :$id";
        $q = $this->dbh->prepare($sql);
        $q->bindParam('id',$id, PDO::PARAM_INT);
        $q->execute();
    }

    public function close()
    {
        $this->dbh = null;
    }
}