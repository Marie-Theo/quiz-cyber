<?php

require_once __DIR__ . '/../ConnexionBDD.php';
require_once 'Compte.php';

session_start();

class Register extends Compte {

    protected PDO $pdo;
    protected array $result;

    public function __construct() {
        $bdd = new ConnexionBDD();
        $this->pdo = $bdd->conn;

        $this->pseudo = $_POST['register-username'];
        $this->mdp = $this->convertStrHash($_POST['register-password']);

        echo "<div style='position: relative;color: #ff7700;'>Pseudo :" . $this->pseudo . "<br>MDP :" . $this->mdp . "</div>";

        $this->requestsUserExist();

        echo $this->result;
        var_dump($this->result);

        if ( $this->result !== [] ){
            echo "2<div style='position: relative;color: #f00;'>Utilisateur introuvable</div>";
            $_SESSION["Information_Incorrect"] = "Nom d'utilisateur déjà utilisé";
            // header('Location: /index.php');
        }

        echo "3<div style='position: relative;color: #ff7700;'>Nom d'utilisateur libre</div>";

        $this->InsertNewUser($pseudo=$this->pseudo, $mdp=$this->mdp);
    }

    private function requestsUserExist(){
        try {
            $stmt = $this->pdo->prepare("SELECT id FROM User WHERE Pseudo = :pseudo LIMIT 1");
            
            $stmt->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
            
            $stmt->execute();

            $this->result = $stmt->fetchAll();
            
        } catch (PDOException $e) {
            echo "<div style='position: relative;color: #f00;'>Requests failed:<br>" . $e->getMessage() . "</div>";
            $_SESSION["Erreur_Inattendue"] = "Requests failed:<br>" . $e->getMessage();
            // header('Location: /from.connexion.php');
        }
    }
}

new Register();