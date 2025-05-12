<?php

abstract class BaseController {
    public PDO $pdo;
    public function setPdo(PDO $pdo){
        $this->pdo=$pdo;
    }
    public function getContext(): array {
        return [];
    }
    abstract public function get();
}
