<?php
/**
 * Created by PhpStorm.
 * User: pashok
 * Date: 05.07.15
 * Time: 20:12
 */

class AdminMigration extends DataBase
{
    function __construct()
    {
        parent::__construct();
    }
    public function up()
    {
        $sql = "CREATE TABLE Book.admin
                ( id INT NOT NULL AUTO_INCREMENT ,
                login VARCHAR(256) NOT NULL ,
                 password VARCHAR(256) NOT NULL ,
                  PRIMARY KEY (id))
                  ENGINE = InnoDB;";
        $q = $this->dbh->prepare($sql);
        $q->execute();
    }
    public function down()
    {
        $sql = "DROP TABLE admin";
        $q = $this->dbh->prepare($sql);
        $q->execute();
    }
}