<?php
namespace App;

class Connection {
    private $pdo;

    public function connectSQL() {
        if($this->pdo == null) {
            $this->pdo = new \PDO("sqlite:". Config::DB_PATH);
        }
        return $this->pdo;
    }
}
