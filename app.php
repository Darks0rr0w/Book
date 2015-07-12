<?php
/**
 * Created by PhpStorm.
 * User: pashok
 * Date: 11.07.15
 * Time: 13:36
 */

require_once('Entry.php');

class App
{
    public static function deleteEntries()
    {

            $entries = $_POST['delete'];
            if (!empty($entries)) {
                foreach ($entries as $id) {
                    Entry::delete($id);
                }
            }
    }
    public static function updateStatus()
    {
            $obj = new Entry();
            $obj->status = 1;
            $entries = $_POST['review'];
            if (!empty($entries)) {
                foreach ($entries as $id) {
                    $obj->update($id);
                }
            }
    }
    public static function saveEntry()
    {
        $content = trim(strip_tags($_POST['content']));
        $entry = new Entry();
        $entry->content = $content;
        $entry->save();
    }
    public static function displayAll()
    {
        try {
            $total = Entry::count();

            $limit = 5;

            $pages = ceil($total / $limit);

            $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
                'options' => array(
                    'default'   => 1,
                    'min_range' => 1,
                ),
            ));

            $offset = ($page - 1)  * $limit;

            if($pages >= $page){
               $entries =  Entry::findAll($limit, $offset);
            }

            if(!empty($entries)){
                $entries->setFetchMode(PDO::FETCH_ASSOC);
                $iterator = new IteratorIterator($entries);

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
        DBConnection::disconnect();
    }

}