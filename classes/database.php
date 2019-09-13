<?php

require 'conf.php';

class database
{
    private $connection;
    public function __construct()
    {
        $this->connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    }

    public function query($sql)
    {
        $query = mysqli_query($this->connection, $sql);
        if ($query == false){
            echo mysqli_error($this->connection);
            echo $sql;
            exit;
        }
        return $query;
    }


}