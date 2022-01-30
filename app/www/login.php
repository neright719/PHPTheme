<?php
require(__DIR__ . '/utl/pdowrapper.php');
require(__DIR__ . '/utl/authorization.php');
require(__DIR__ . '/utl/token.php');
require(__DIR__ . '/utl/crudapp.php');
require(__DIR__ . '/utl/redirect.php');
require(__DIR__ . '/utl/msg.php');


Authorize::isTrue(function($session, $method, $data) {
    Redirect::Jump("index");
});

Authorize::isFalse(function($session, $method, $data) {

    if ($method === "POST") {
        $crudapp = new CRUDApp();
        $crudapp->exec("login", function(){
            Redirect::jump("index");
        }, function(){
            Redirect::jump("login");
        });
        
    }
    $data["msg"] = Msg::read();
    return $data;
});

$data = Authorize::Confirm([]);
$csrf_token = Token::generate();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/login.css">
    <title>ログイン / CRUD-App</title>
</head>
<body>
    <div class="container">
        <div>
            <form class="login_form" action="" method="POST">
                <p><label for="email">
                    <span>メールアドレス</span>

                    <?php if (isset($data["msg"]["email"])): ?>
                        <span class="alert"><?= $data["msg"]["email"]; ?></span>
                    <?php endif; ?>

                </label></p>
                <p><input autocomplete="email" type="email" name="email" id="email"></p>
                <p><label for="password">
                    <span>パスワード</span>

                    <?php if (isset($data["msg"]["password"])): ?>
                        <span class="alert"><?= $data["msg"]["password"]; ?></span>
                    <?php endif; ?>

                </label></p>
                <p><input autocomplete="current-password" type="password" name="password" id="password"></p>
                <p><button class="login_button">ログイン</button></p>
                <input type="hidden" name="csrf_token" value="<?= $csrf_token; ?>">
            </form>
            <p class="under_link"><a href="/signup.php">新規ユーザー登録をする</a></p>
        </div>
    </div>
</body>
</html>