<?php

class Redirect {

    static private $page_name = [
        "signup" => "/signup.php",
        "login"  => "/login.php",
        "index"  => "/",
        "create" => "/?action=crate",
        "delete" => "/?action=delete",
        "update" => "/?action=update"
    ];

    static public function Jump($page_name) {
        $url = self::$page_name[$page_name];
        header("Location: " . $url);
        exit();
    }

}