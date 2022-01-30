<?php
//PDOのWrapperクラス
//DBのログイン情報は環境変数で定義するべきだと思われるが、課題のため直接記述する。


class PDOWrapper {

    //TODO: 環境変数で定義する。
    private $CONNECT_INFO = [
        "dsn"      => "mysql:host=mariadb;dbname=crudapp;charset=utf8;",
        // "dsn"      => "sqlite:/var/www/crudapp.sqlite3"
        "user"     => "docker",
        "password" => "docker"
    ];

    private $pdo;

    private $stmts = [
        "INSERT" => "INSERT INTO users(email, password) VALUES(:mail_address, :password);",
        "SELECT" => [
            "TABLE" => "SELECT * FROM users ORDER BY id DESC;",
            "ID"    => "SELECT * FROM users WHERE id = :id;",
            "MAIL"  => "SELECT * FROM users WHERE email = :mail_address;"
        ],
        "UPDATE" => "UPDATE users SET email = :mail_address, password = :password, updated_at = CURRENT_TIMESTAMP WHERE id = :id;",
        "DELETE" => "DELETE FROM users WHERE id = :id"
    ];

    function __construct() {
        try {
            $this->pdo = new PDO(
                $this->CONNECT_INFO["dsn"],
                $this->CONNECT_INFO["user"],
                $this->CONNECT_INFO["password"]
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        } catch (PDOException $e) {
            print($e->getMessage());
            die();
        }
    }

    public function Insert($mail_address, $password) {
        try {
            $stmt = $this->pdo->prepare($this->stmts["INSERT"]);
            $stmt->bindParam(':mail_address', $mail_address);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
        } catch (PDOException $e) {
            print($e->getMessage());
            die();
        }
    }

    public function SelectTable() {
        try {
            $stmt = $this->pdo->prepare($this->stmts["SELECT"]["TABLE"]);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print($e->getMessage());
            die();
        }
    }

    public function SelectId($id) {
        try {
            $stmt = $this->pdo->prepare($this->stmts["SELECT"]["ID"]);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print($e->getMessage());
            die();
        }
    }

    public function SelectMailAddress($mail_address) {
        try {
            $stmt = $this->pdo->prepare($this->stmts["SELECT"]["MAIL"]);
            $stmt->bindParam(':mail_address', $mail_address);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print($e->getMessage());
            die();
        }
    }

    public function Update($id, $mail_address, $password) {
        try {
            $stmt = $this->pdo->prepare($this->stmts["UPDATE"]);
            $stmt->bindParam(':mail_address', $mail_address);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            print($e->getMessage());
            die();
        }
    }

    public function Delete($id) {
        try {
            $stmt = $this->pdo->prepare($this->stmts["DELETE"]);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            print($e->getMessage());
            die();
        }
    }

}