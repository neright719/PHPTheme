<div class="table create" id="create">
    <div class="table_head">
        <div class="table_row">
            <span class="column_mail">メールアドレス</span>
            <span class="column_password">パスワード</span>
            <span class="column_password">パスワード(確認用)</span>
        </div>
    </div>
    <div class="table_body">
            <form action="" method="POST">
                <div class="table_row">
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
                    <span class="column_password alert">
                        <?php if (isset($data["msg"]["password"])): ?>
                            <?= $data["msg"]["password"]; ?>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="table_row">
                    <span class="column_mail"><input type="email" name="email"></span>
                    <span class="column_password"><input type="password" name="password"></span>
                    <span class="column_password"><input type="password" name="password_again"></span>
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token; ?>">
                </div>
                <div class="btn_row"><button class="send_btn">登録する</button></div>
            </form>
    </div>
</div>
<p class="under_link"><a href="/">トップへ戻る</a></p>