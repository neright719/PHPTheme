<?php

class Token {

    private static $label = 'csrf_token';

    public static function Generate() {
        if (empty($_SESSION[self::$label])) {
            $token = bin2hex(random_bytes(32));
            $_SESSION[self::$label] = $token;
            return $token;
        } else {
            return $_SESSION['csrf_token'];
        }
    }

    public static function Validate($token) {
        if (isset($_SESSION[self::$label]) && $token === $_SESSION[self::$label]) {
            unset($_SESSION['csrf_token']);
            return true;
        } else {
            return false;
        }
    }

}