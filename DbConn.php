<?php

class DbConnect
{
    private $conn;

    function __construct()
    {
    }

    function connect()
    {
        $servername = getenv('DATABASE_SERVER_NAME');
        $username = getenv('DATABASE_USER_NAME');
        $password = getenv('DATABASE_PASSWORD');
        $database = getenv('DATABASE_DB');
        $this->conn = new mysqli($servername, $username,$password,$database);

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        return $this->conn;
    }
}