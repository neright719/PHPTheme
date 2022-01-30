<div class="table delete" id="delete">
    <div class="table_head">
        <div class="table_row">
        <span class="column_id">ID</span>
            <span class="column_mail">メールアドレス</span>
            <span class="column_created_at">作成日時</span>
            <span class="column_updated_at">更新日時</span>
        </div>
    </div>
    <div class="table_body">
        <?php foreach ($data["records"] as $record) :?>
        <form action="/?action=delete" method="POST">
            <div class="table_row">
                <span class="column_id"><input type="hidden" name="id" value="<?= $record["id"]; ?>"><?= $record["id"]; ?></span>
                <span class="column_mail"><?= $record["email"]; ?></span>
                <span class="column_created_at"><?= $record["created_at"]; ?></span>
                <span class="column_updated_at"><?= $record["updated_at"]; ?></span>
                <input type="hidden" name="csrf_token" value="<?= $csrf_token; ?>">
            </div>
            <div class="btn_row"><button class="send_btn">削除する</button></div>
        </form>
        <?php endforeach; ?>
    </div>
</div>
<p class="under_link"><a href="/">トップへ戻る</a></p>