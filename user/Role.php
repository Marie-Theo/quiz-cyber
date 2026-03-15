<?php

class Role {

    private int $id;
    private string $tag;
    private string $description;
    private bool $isAdmin;
    private bool $isEditor;
    private bool $isDataAnalyst;

    public function __construct(int $id, string $tag, string $description, bool $Admin, bool $Editor, bool $DataAnalyst) {
        $this->id = $id;
        $this->tag = $tag;
        $this->description = $description;
        $this->isAdmin = $Admin;
        $this->isEditor = $Editor;
        $this->isDataAnalyst = $DataAnalyst;
    }

}