<?php
//ログアウト処理を行うページ
//セッションがあれば削除を行い、indexへリダイレクトさせる

require(__DIR__ . '/utl/authorization.php');

Authorize::isTrue(function($session, $request_method) {
    $_SESSION = array();
    session_destroy();
    header('Location: http://localhost:8080');
    exit();
});
Authorize::isFalse(function($session, $request_method) {
    header('Location: http://localhost:8080');
    exit();
});
Authorize::Confirm([]);