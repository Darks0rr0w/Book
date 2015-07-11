<?php
/**
 * Created by PhpStorm.
 * User: z1m
 * Date: 01.07.2015
 * Time: 19:41
 */

require_once('DataBase.php');
require_once('Admin.php');


class Entry extends DataBase
{


    function __construct()
    {
        parent::__construct();
    }

    public function save($content)
    {
            $sql = "INSERT INTO entry (content) VALUES (:content)";
            $q = $this->dbh->prepare($sql);
            $q->bindParam(':content', $content, PDO::PARAM_STR);
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



        try {

            // Find out how many items are in the table
            $total = $this->dbh->query('SELECT COUNT(*) FROM entry')->fetchColumn();

            // How many items to list per page
            $limit = 5;

            // How many pages will there be
            $pages = ceil($total / $limit);

            // What page are we currently on?
            $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
                'options' => array(
                    'default'   => 1,
                    'min_range' => 1,
                ),
            ));

            // Calculate the offset for the query
            $offset = ($page - 1)  * $limit;

            $stmt = null;
            if ($pages >= $page) {
                // Prepare the paged query
                $stmt = $this->dbh->prepare('SELECT * FROM entry ORDER BY date LIMIT :limit OFFSET :offset');

                // Bind the query params
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
            }

            // Do we have any results?
            if ($stmt != null) {
                // Define how we want to fetch the results
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $iterator = new IteratorIterator($stmt);

                // Display the results
                foreach ($iterator as $row) {

                    echo '<blockquote>';
                    echo $row['content'];
                    echo $row['status'] ? '<footer>reviewed</footer>':'<footer>not reviewed</footer>';
                    if (Admin::isAdmin()){
                        echo '<div class="form-group">';
                            echo '<div class="col-sm-offset-0 col-sm-10">';
                                echo '<div class="checkbox">';
                                    if ($row['status'] == false ) {
                                        echo '<label class="checkbox-inline">';
                                        echo '<input type="checkbox" name="review[]"  value="' . $row['id'] . '"/>Mark as reviewed';
                                        echo '</label>';
                                    }
                                    echo '<label class="checkbox-inline">';
                                    echo '<input type="checkbox" name="delete[]"  value="'.$row['id'].'"/>Delete entry';
                                    echo '<label>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                    echo '</blockquote>';
                    echo '<hr>';
                }

            } else {
                echo '<p>Nothing to display.</p>';
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

    public  function update($id)
    {
            $sql = "UPDATE entry SET status = 1  WHERE id = :id";
            $q = $this->dbh->prepare($sql);
            $q->bindParam('id',$id, PDO::PARAM_INT);
            $q->execute();

    }

    public function close()
    {
        $this->dbh = null;
    }
}