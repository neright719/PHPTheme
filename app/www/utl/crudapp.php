<?php

class CRUDApp {
    private $pdo;
    private $input_labels = ["id", "email", "password", "password_again", "csrf_token", "created_at", "updated_at"];
    private $data = [];

    public function __construct() {
        $this->pdo =  new PDOWrapper();
        foreach ($this->input_labels as $label) {
            $this->data[$label] = htmlspecialchars(filter_input(INPUT_POST, $label));
        }
    }

    public function Create() {
        $flag = true;
        if (empty($this->data["email"])) {
            Msg::regist("email", "not_input");
            $flag = false;
        }
        if (empty($this->data["password"])) {
            Msg::regist("password", "not_input");
            $flag = false;
        }
        if (empty($this->data["password_again"])) {
            Msg::regist("password", "not_input");
            $flag = false;
        }
        if ($this->data["password"] !== $this->data["password_again"]) {
            Msg::regist("password", "not_match");
            $flag = false;
        }
        if (!$flag) {
            return false;
        }
        $record = $this->pdo->SelectMailAddress($this->data["email"]);
        if (!empty($record)) {
            Msg::regist("email", "exists");
            return false;
        }
        $password = password_hash($this->data["password"], PASSWORD_DEFAULT);
        $this->pdo->Insert($this->data["email"], $password);
        return true;
    }

    public function Read($id=null) {

        if ($id) {
            $records = $this->pdo->SelectId($id);
        } else {
            $records = $this->pdo->SelectTable();
        }
        if (isset($records)) {
            return $records;
        }
    }

    public function Update() {

        if (empty($this->data["id"])) {
            Msg::regist("id", "not_registed");
            return false;
        }
        $record = $this->pdo->SelectId($this->data["id"]);
        if (empty($record)) {
            Msg::regist("id", "not_registed");
            return false;
        }
        $record = $record[0];
        if ($record["email"] === $this->data["email"] || empty($this->data["email"])) {
            $email = $record["email"];
        } else {
            $email = $this->data["email"];
        }

        if ($record["password"] === $this->data["password"] || empty($this->data["password"])) {
            $password = $record["password"];
        } else {
            $password = $this->data["email"];
        }

        $this->pdo->Update($this->data["id"], $email, $password);
        return true;
    }

    public function Delete() {

        if (empty($this->data["id"])) {
            Msg::regist("id", "not_registed");
            return false;
        }
        $record = $this->pdo->SelectId($this->data["id"]);
        if (empty($record)) {
            Msg::regist("id", "not_registed");
            return false;
        }
        $this->pdo->Delete($this->data["id"]);
        return true;
    }

    public function Login() {

        if (empty($this->data["email"])) {
            Msg::regist("email", "not_input");
            return false;
        }
        if (empty($this->data["password"])) {
            Msg::regist("password", "not_input");
            return false;
        }
        $record = $this->pdo->SelectMailAddress($this->data["email"]);
        if (empty($record)) {
            Msg::regist("email", "not_found");
            return false;
        }
        $registed_password = $record[0]["password"];
        if (!password_verify($this->data["password"], $registed_password)) {
            Msg::regist("password", "not_match");
            return false;
        }
        session_regenerate_id(true);
        $_SESSION['authorization'] = true;
        $_SESSION['email'] = $this->data["email"];
        return true;
    }

    public function Signup() {
        if (empty($this->data["email"])) {
            Msg::regist("email", "not_input");
            return false;
        }
        if (empty($this->data["password"])) {
            Msg::regist("password", "not_input");
            return false;
        }
        if (empty($this->data["password_again"])) {
            Msg::regist("password", "not_input");
            return false;
        }
        if ($this->data["password"] !== $this->data["password_again"]) {
            Msg::regist("password", "not_match");
            return false;
        }
        $record = $this->pdo->SelectMailAddress($this->data["email"]);
        if (!empty($record)) {
            Msg::regist("email", "exists");
            return false;
        }
        $password = password_hash($this->data["password"], PASSWORD_DEFAULT);
        $this->pdo->Insert($this->data["email"], $password);
        return true;
    }

    public function exec($action, $done, $fail) {

        if (empty($this->data['csrf_token']) || !Token::Validate($this->data['csrf_token'])) {
            $fail($action);
            return false;
        }

        switch ($action) {
            case "signup":
                $result = $this->Signup();
                break;
            case "login":
                $result = $this->Login();
                break;
            case "create":
                $result = $this->Create();
                break;
            case "read":
                $result = $this->Read();
                break;
            case "update":
                $result = $this->Update();
                break;
            case "delete":
                $result = $this->Delete();
                break;
        }

        if ($result) {
            $done($action);
        } else {
            $fail($action);
        }
    }
}