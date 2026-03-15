<?php

require_once __DIR__.'/Role.php';

abstract class Compte {

    private int $id;
    private string $pseudo;
    private string $mdp;
    private string $email;
    private Role $role;

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

    public function setId():int {
        return $this->id;
    }

    public function getPseudo():string {
        return $this->pseudo;
    }

    public function setPseudo():string {
        return $this->pseudo;
    }

    public function getEmail():string {
        return $this->email;
    }
    public function setEmail():string {
        return $this->email;
    }
    public function convertStrHash(string $mdp):string {
        $this->mdp = password_hash( $mdp, PASSWORD_DEFAULT);
        return $this->mdp;
    }
}