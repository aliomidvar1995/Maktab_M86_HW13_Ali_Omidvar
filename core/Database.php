<?php

namespace core;
use PDO;

class Database{
    public PDO $conn;

    public function __construct(array $config) {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->conn = new PDO($dsn, $user, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigration() {
        $this->createMigrationTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];

        $files = scandir(Application::$ROOT_DIR.'/migration');

        $toApplyMigrations = array_diff($files, $appliedMigrations);

        foreach($toApplyMigrations as $migration) {
            if($migration === '.' || $migration === '..') {
                continue;
            }
            require_once(Application::$ROOT_DIR.'/migration/'.$migration);
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className;
            $this->log("applying migration $migration");
            $instance->up();
            $this->log("applied migration $migration");
            $newMigrations[] = $migration;
        }
        if(!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        }else {
            $this->log('all migrations are applied');
        }
    }
    public function createMigrationTable() {
        $this->conn->exec("CREATE TABLE IF NOT EXISTS migrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        migration VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
    }

    public function getAppliedMigrations() {
        $statement = $this->conn->prepare("SELECT migration FROM migrations");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations) {
        $src = implode(',', array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->conn->prepare("INSERT INTO migrations (migration) VALUES
        $src
        ");
        $statement->execute();
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    protected function log($message) {
        print('['.date('Y-m-d H:i:s').'] - '.$message.PHP_EOL);
    }
}