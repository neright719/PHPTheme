<div class="table update" id="update">
    <div class="table_head">
        <div class="table_row">
        <span class="column_id">ID</span>
            <span class="column_mail">メールアドレス</span>
            <span class="column_password">パスワード</span>
            <span class="column_password">作成日時</span>
            <span class="column_password">更新日時</span>
        </div>
    </div>
    <div class="table_body">
        <?php foreach ($data["records"] as $record) :?>
        <form action="" method="POST">
            <div class="table_row">
                <span class="column_id"></span>
                <span class="column_mail alert">
                    <?php if (isset($data["msg"]["email"])): ?>
                        <?= $data["msg"]["email"]; ?>
                    <?php endif; ?>
                </span>
                <span class="column_password alert">
                    <?php if (isset($data["msg"]["password"])): ?>
                        <?= $data["msg"]["password"]; ?>
                    <?php endif; ?>
                </span>
                <span class="column_password"></span>
            </div>
            <div class="table_row">
                <?= isset($data["msg"]["email"]) ?>
                <span class="column_id"><input type="hidden" name="id" value="<?= $record["id"]; ?>"><?= $record["id"]; ?></span>
                <span class="column_mail"><input type="email" name="email" value="<?= $record["email"]; ?>"></span>
                <span class="column_password"><input type="text" name="password" value="<?= $record["password"]; ?>"></span>
                <span class="column_password"><?= $record["created_at"]; ?></span>
                <span class="column_password"><?= $record["updated_at"]; ?></span>
                <input type="hidden" name="csrf_token" value="<?= $csrf_token; ?>">
            </div>
            <div class="btn_row"><button class="send_btn">更新する</button></div>
        </form>
        <?php endforeach; ?>
    </div>
</div>
<p class="under_link"><a href="/">トップへ戻る</a></p>