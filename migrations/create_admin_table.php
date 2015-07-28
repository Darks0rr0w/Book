<?php
/**
 * Created by PhpStorm.
 * User: pashok
 * Date: 05.07.15
 * Time: 20:12
 */

require_once($_SERVER['DOCUMENT_ROOT'].'SnC/DBConnection');

class AdminMigration
{

    public function up()
    {
        $conn = DBConnection::connect();
        $sql = "CREATE TABLE SnC.admin
                ( id INT NOT NULL AUTO_INCREMENT ,
                  login VARCHAR(256) NOT NULL ,
                  password VARCHAR(256) NOT NULL ,
                  PRIMARY KEY (id))
                  ENGINE = InnoDB;";
        $q = $conn->prepare($sql);
        $q->execute();
        DBConnection::disconnect();
    }
    public function down()
    {
        $conn = DBConnection::connect();
        $sql = "DROP TABLE admin";
        $q = $conn->prepare($sql);
        $q->execute();
        DBConnection::disconnect();
    }
}