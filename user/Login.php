<?php

require_once __DIR__ . '/../ConnexionBDD.php';
require_once 'Compte.php';

session_start();

class Login extends Compte {

    protected PDO $pdo;
    protected array $result;

    public function __construct() {
        $bdd = new ConnexionBDD();
        $this->pdo = $bdd->conn;

        $this->pseudo = $_POST['login-username'];
        $this->mdp = $this->convertStrPepper($_POST['login-password']);

        // echo "<div style='position: relative;color: #ff7700;'>Pseudo :" . $this->pseudo . "<br>MDP :" . $this->mdp . "</div>";

        $this->requestsHash_MDP();

        if ( $this->result === [] ){

            // echo "<div style='position: relative;color: #f00;'>Utilisateur introuvable</div>";
            $_SESSION["Information_Incorrect"] = "Username unfound";
            header('Location: /index.php');
        }
        // echo "<div style='position: relative;color: #ff7700;'>Utilisateur trouvé</div>";

        if ( password_verify($this->mdp, $this->result[0]['Hash_MDP']) ) {
            $this->getAllAboutUser($this->pseudo);
            header('Location: /index.php');
        }
        else {
            echo "<div style='position: relative;color: #f00;'>password doesn't matches</div>";
            $_SESSION["Information_Incorrect"] = "PassWord False";
            header('Location: /index.php');
        }
    }

    private function requestsHash_MDP(){
        try {
            $stmt = $this->pdo->prepare("SELECT Hash_MDP FROM User WHERE Pseudo = :pseudo LIMIT 1");
            
            $stmt->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
            
            $stmt->execute();

            $this->result = $stmt->fetchAll();
            
        } catch (PDOException $e) {
            echo "<div style='position: relative;color: #f00;'>Requests failed:<br>" . $e->getMessage() . "</div>";
            $_SESSION["Erreur_Inattendue"] = "Requests failed:<br>" . $e->getMessage();
            header('Location: /from.connexion.php');
        }
    }
}

new Login();