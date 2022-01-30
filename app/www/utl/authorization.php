<?php
//セッションの生存時間の設定。30分。
session_start(['cookie_lifetime' => 60 * 30]);

// ログインを認証するクラス
// isTrue,isFalseに承認時、非承認時に実行する関数を渡す。
// Confirmは承認の確認を行い、引数で与えられたデータをisTrue,isFalseに渡して実行する。

class Authorize {
    
    private static $funcs = [];

    public static function isTrue($func) {
        self::$funcs["true"] = $func;
    }

    public static function isFalse($func) {
        self::$funcs["false"] = $func;
    }

    public static function Confirm($data) {

        if (isset($_SESSION['authorization'])) {
            return self::$funcs["true"]($_SESSION, $_SERVER["REQUEST_METHOD"], $data);
        } else {
            return self::$funcs["false"]($_SESSION, $_SERVER["REQUEST_METHOD"], $data);
        }
    }
}