<?php

namespace wii\dao;

class Postgres {

    /**
     * @var \PDO
     */
    private $pdo;
    private $dbName = 'wii';

    public function __construct() {
        $this->pdo = new \PDO('pgsql:host=localhost;dbname=' . $this->dbName, 'postgres', '');
        $this->createTablesIfNotExists();
    }

    private function createTablesIfNotExists() {
        $checkTableQuery = 'SELECT * FROM "person" LIMIT 1';

        if (!$this->pdo->query($checkTableQuery)) {
            $tPerson = '';
            $tPSMS = '';
            $tDSMS = '';
            $tDialog = '';
            $tDialogConnect = '';
        }
    }
}