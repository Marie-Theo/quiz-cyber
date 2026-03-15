<?php

require_once __DIR__ . '/../ConnexionBDD.php';
require_once 'Compte.php';

session_start();

class Login extends Compte {

    private string $pseudo;
    private string $mdp;
    private PDO $pdo;
    protected array $result;

    public function __construct() {
        $bdd = new ConnexionBDD();
        $this->pdo = $bdd->conn;

        $this->pseudo = $_POST['login-username'];
        $this->mdp = $this->convertStrHash($_POST['login-password']);

        echo "<div style='position: relative;color: #ff7700;'>Pseudo :" . $this->pseudo . "<br>MDP :" . $this->mdp . "</div>";

        $this->requestsHash_MDP();

        if ( $this->result === [] ){
            echo "<div style='position: relative;color: #f00;'>Utilisateur introuvable</div>";
            return false;
        }
        echo "<div style='position: relative;color: #ff7700;'>Utilisateur trouvé</div>";
    }

    private function requestsHash_MDP(){
        try {
            $stmt = $this->pdo->prepare("SELECT 'Hash_MDP' FROM User WHERE Pseudo = :pseudo LIMIT 1");
            
            $stmt->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
            
            $stmt->execute();

            $this->result = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "<div style='position: relative;color: #f00;'>Requests failed:<br>" . $e->getMessage() . "</div>";
        }
    }
}

new Login();