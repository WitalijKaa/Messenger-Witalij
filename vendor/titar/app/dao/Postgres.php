<?php

namespace ww\dao;

class Postgres {

    /**
     * @var \PDO
     */
    private $pdo;
    private $dbName = 'wii';

    public function __construct() {
        $this->pdo = new \PDO('pgsql:host=localhost;dbname=' . $this->dbName, 'postgres', 'localpass');
        $this->createTablesIfNotExists();
    }

    private function createTablesIfNotExists() {
        $checkTableQuery = 'SELECT * FROM "person" LIMIT 1';

        if (!$this->pdo->query($checkTableQuery)) {
            $migrationsPath = WW_CODE_PATH . 'vendor/mgrn/';

            $tP = include $migrationsPath . 'person.migration';
            $tPSMS = include $migrationsPath . 'sms_p.migration';
            $tD = include $migrationsPath . 'dialog.migration';
            $tDC = include $migrationsPath . 'dialog_connect.migration';
            $tDSMS = include $migrationsPath . 'sms_d.migration';

            $this->pdo->exec($tP);
            $this->pdo->exec($tPSMS);
            $this->pdo->exec($tD);
            $this->pdo->exec($tDC);
            $this->pdo->exec($tDSMS);
        }
    }
}