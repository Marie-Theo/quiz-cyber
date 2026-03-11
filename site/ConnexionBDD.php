<?php

use Dotenv\Dotenv;

require_once '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(  __DIR__  );
$dotenv->load();
class ConnexionBDD {

    private string $host = "localhost";
    private string $dbname;
    private string $username;
    private string $usermdp;
    public PDO $conn;

    function __construct() {

        $this->dbname = $_ENV['DBNAME'];
        $this->username = $_ENV['USER_DATABASES'];
        $this->usermdp = $_ENV['MDP_DATABASES'];

        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->usermdp);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage() . "";
        }
    }
}