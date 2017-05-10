<?php
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

    public function insertAndReturnId($sql, $table)
    {
        @parent::query($sql);
        if ($this->error) {
            return $this->error;
        }
        return @parent::query('SELECT MAX(id) as id FROM ' . $table);
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