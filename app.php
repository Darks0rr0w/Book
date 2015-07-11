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

            $obj = new Entry();
            $entries = $_POST['delete'];
            if (!empty($entries)) {
                foreach ($entries as $id) {
                    $obj->delete($id);
                }
            }
    }

    public static function updateStatus()
    {
            $obj = new Entry();
            $entries = $_POST['review'];
            if (!empty($entries)) {
                foreach ($entries as $id) {
                    $obj->update($id);
                }
            }
    }
    public static function saveEntry()
    {
        $content = trim($_POST['content']);
        $test = new Entry();
        $test->save($content);
    }

}