<?php

class Msg {
    private static $msgs = [
        "id" => [
            "not_registed" => "レコードが見つかりません"
        ],
        "email" => [
            "not_found" => "メールアドレスが見つかりません",
            "not_input" => "メールアドレスを入力してください",
            "not_match" => "メールアドレスが一致しません",
            "exists" => "メールアドレスが既に登録されています"
        ],
        "password" => [
            "not_match" => "パスワードが一致しません",
            "not_input" => "パスワードを入力してくだい"
        ]
    ];

    public static function regist($category, $label) {
        if (empty($_SESSION["msgs"])) {
            $_SESSION["msgs"] = [];
        }
        $_SESSION["msgs"][$category] = self::$msgs[$category][$label];
    }

    public static function read() {
        if (isset($_SESSION["msgs"])) {
            $msgs = $_SESSION["msgs"];
            unset($_SESSION["msgs"]);
            return $msgs;
        }
    }
}
