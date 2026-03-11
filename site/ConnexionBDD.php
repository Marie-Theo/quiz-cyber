<?php

class ConnexionBDD {

    private string $host = "localhost";
    private string $dbname;
    private string $username;
    private string $usermdp;

    function __construct() {

        // $this->dbname = $_ENV['DBNAME'];
        // $this->username = $_ENV['USER_DATABASES'];
        // $this->usermdp = $_ENV['MDP_DATABASES'];
        try {
            $this->conn = new PDO("mysql:host= $this->host;dbname= $this->dbname", $this->username, $this->usermdp);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        } catch (PDOException $e) {
            echo "<p>Connection failed: " . $e->getMessage() . "</p>";
        }
        echo "<p>Connected successfully</p>";
    }
}