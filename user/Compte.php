<?php

use Dotenv\Dotenv;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__.'/Role.php';

abstract class Compte {

    private int $id;
    private string $pseudo;
    private string $mdp;
    private string $email;
    private Role $role;
    private string $salt;

    public function __construct($id, $pseudo, $email, $mdp, Role $role, $bdd) {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->mdp = $mdp;
        $this->email = $email;
        $this->role = $role;
    }

    public function getId():int {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getPseudo():string {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo) {
        $this->pseudo = $pseudo;
    }

    public function getEmail():string {
        return $this->email;
    }
    
    public function setEmail(string $email) {
        $this->email = $email;
    }

    protected function getAllAboutUser($pseudo) {
        try {
            $stmt = $this->pdo->prepare("SELECT id, Mail FROM User WHERE Pseudo = :pseudo LIMIT 1");
            
            $stmt->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            
            $stmt->execute();

            $this->result = $stmt->fetchAll();
            
        } catch (PDOException $e) {
            // echo "<div style='position: relative;color: #f00;'>Requests failed:<br>" . $e->getMessage() . "</div>";
            $_SESSION["Erreur_Inattendue"] = "Requests failed:<br>" . $e->getMessage();
            header('Location: /from.connexion.php');
        }

        $_SESSION['id'] = $this->result[0]['id'];
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['mail'] = $this->result[0]['Mail'];
    }

    public function getSalt():string {
        if ( !isset( $this->salt ) ){
            $dotenv = Dotenv::createImmutable( __DIR__ . "/../" );
            $dotenv->load();
            $this->salt = $_ENV['SALT'];
        }
        return $this->salt;
    }

    public function convertStrPepper(string $mdp):string {
        $salt = $this->getSalt();

        $this->mdp = hash_hmac("sha256", $mdp, $salt);

        return $this->mdp;
    }

    public function convertStrHash(string $mdp):string {
        $salt = $this->getSalt();

        $mdp_peppered = hash_hmac("sha256", $mdp, $salt);
        $this->mdp = password_hash($mdp_peppered, PASSWORD_ARGON2ID);

        return $this->mdp;
    }

    public InsertNewUser($pseudo, $mdp) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO User (Pseudo, Hash_MDP) VALUES ( :pseudo , :mdp )");
            
            $stmt->bindParam(':pseudo', $pseudo);
            $stmt->bindParam(':mdp', $mdp);

            // $stmt->execute();
        } catch (PDOException $e) {
            echo "<div style='position: relative;color: #f00;'>Requests failed:<br>" . $e->getMessage() . "</div>";
            $_SESSION["Erreur_Inattendue"] = "Requests failed:<br>" . $e->getMessage();
            // header('Location: /from.connexion.php');
        }
    }
}