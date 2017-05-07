<?php

/**
 * Created by PhpStorm.
 * User: aizen115
 * Date: 6/3/2016
 * Time: 1:45 PM
 */
class DB extends \mysqli
{
    public $host = "localhost:3306";
    public $user = "root";
    public $password = "root";
    public $dbName = "mydb";

    public function __construct($host = null, $user = null, $password = null, $dbName = null)
    {
        parent::__construct($this->host, $this->user, $this->password, $this->dbName);

        if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') ' .
                mysqli_connect_error());
        }
    }

    public function query($sql)
    {
        $result = @parent::query($sql);
        if ($this->error) {
            return $this->error;
        }
        return $result;
    }

    public function insertAndReturnId($sql)
    {
        @parent::query($sql);
        if ($this->error) {
            return $this->error;
        }
        return @parent::insert_id;
    }

    public function queryOneRow($sql)
    {
        $result = @parent::query($sql);
        if ($this->error) {
            return $this->error;
        }
        return $result->fetch_assoc();
    }
}