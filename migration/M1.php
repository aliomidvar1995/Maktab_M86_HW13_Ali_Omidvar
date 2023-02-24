<?php
use core\Application;

class M1 {

    public function up() {
        $db = Application::$app->database;
        $SQL = "CREATE TABLE users (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            rule VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL
        )";
        $db->conn->exec($SQL);
    }
    public function down() {
        $db = Application::$app->database;
        $SQL = "DROP TABLE users;";
        $db->conn->exec($SQL);
    }
}
