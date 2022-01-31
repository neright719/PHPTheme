<?php
require(__DIR__ . '/utl/pdowrapper.php');
require(__DIR__ . '/utl/authorization.php');
require(__DIR__ . '/utl/token.php');
require(__DIR__ . '/utl/crudapp.php');
require(__DIR__ . '/utl/redirect.php');
require(__DIR__ . '/utl/msg.php');

Authorize::isTrue(function($session, $request_method, $data) {
    $crudapp = new CRUDApp();
    $id      = htmlspecialchars(filter_input(INPUT_GET, 'id'));
    $action  = htmlspecialchars(filter_input(INPUT_GET, 'action'));
    
    if ($request_method === "GET") {
    }

    if ($request_method === "POST") {
        $crudapp->exec($action, function(){
            Redirect::Jump("index");
        }, function(){
            header("Location: " . $_SERVER["REQUEST_URI"]);
            exit();
        });
    }

    if (empty($data["html"][$action])) {
        $action = "read";
    }
    $data["action"] = $action;
    $data["msg"] = Msg::read();
    $data["records"] = $crudapp->Read($id);

    return $data;
});

Authorize::isFalse(function($session, $request_method) {
    Redirect::Jump("login");
});

$data = Authorize::Confirm([
    "html" => [
        "read"   => "./html/read.php",
        "create" => "./html/create.php",
        "update" => "./html/update.php",
        "delete" => "./html/delete.php"
    ]
]);

$csrf_token = Token::Generate();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>
    <script src="/js/main.js"></script>
    <title>ダッシュボード / CRUD-App</title>
</head>
<body>
    <div class="container">
        <div>
            <nav>
                <p>ログイン中:<?= $_SESSION['email']; ?></p>
                <p class="logout"><a href="/logout.php">ログアウト</a></p>
            </nav>
            <?php require($data["html"][$data["action"]]); ?>
        </div>
    </div>
</body>
</html>
