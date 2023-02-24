<?php

namespace model;
use core\Application;
use core\Model;

class Dbmodel extends Model{

    public static function tableName(): string {
        return 'users';
    }

    public static function primaryKey() {
        return 'id';
    }


    public function save() {
        $tableName = self::tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).")
        VALUES (".implode(',', $params).")");
        foreach($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
    }

    public static function findOne($where) {
        $tableName = self::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public static function prepare($sql) {
        return Application::$app->database->conn->prepare($sql);
    }
}