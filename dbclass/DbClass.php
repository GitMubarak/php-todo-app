<?php

namespace Tasks;

class DbClass
{
    protected $server;
    protected $user;
    protected $pass;
    protected $dbname;
    protected $query;
    protected $result;
    protected $dataContainerArray;
    protected $row;

    protected $conn;

    function __construct($server, $user, $pass, $db)
    {
        $this->server = $server;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbname = $db;

        $this->conn = mysqli_connect($this->server, $this->user, $this->pass, $this->dbname);
        mysqli_select_db($this->conn, $this->dbname) or die(mysqli_error());
    }

    protected function all_tasks($q)
    {
        $this->query = $q;

        $r = mysqli_query($this->conn, $this->query);

        $this->result = $this->get_all_data($r);

        return $this->result;
    }

    protected function get_all_data($r)
    {
        $i = 0;

        while ($this->row = mysqli_fetch_array($r)) {
            $this->dataContainerArray[$i] = $this->row;
            $i++;
        }

        return $this->dataContainerArray;
    }

    protected function task_query($query)
    {
        $this->query = $query;

        $rows_affected = mysqli_query($this->conn, $this->query);

        if ($rows_affected) {
            return true;
        } else {
            return mysqli_error();
        }
    }

    protected function get_last_id()
    {
        return $this->conn->insert_id;
    }
}