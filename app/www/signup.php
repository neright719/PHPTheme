<?php
//新規登録を行うページ
//パスワードを誤って登録しないよう、二重で確認する

require('./utl/authorization.php');
require('./utl/pdowrapper.php');
require('./utl/redirect.php');
require('./utl/msg.php');
require('./utl/token.php');
require('./utl/crudapp.php');


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $crudapp = new CRUDApp();
    $crudapp->exec("signup", function(){
        Redirect::jump("index");
    }, function(){
        Redirect::jump("signup");
    });
    
}
$data["msg"] = Msg::read();

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
    <link rel="stylesheet" href="/css/signup.css">
    <title>新規登録 / CRUD-App</title>
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
                <p><input autocomplete="new-password" type="password" name="password" id="password"></p>
                <p><label for="password_again">
                    <span>パスワード(確認用)</span>

                    <?php if (isset($data["msg"]["password"])): ?>
                        <span class="alert"><?= $data["msg"]["password"]; ?></span>
                    <?php endif; ?>
                    
                </label></p>
                <p><input autocomplete="new-password" type="password" name="password_again" id="password_again"></p>
                <p><button class="login_button">新規登録</button></p>
                <input type="hidden" name="csrf_token" value="<?= $csrf_token; ?>">
            </form>
            <p class="under_link"><a href="/">ログイン画面へ戻る</a></p>
        </div>
    </div>
</body>
</html>