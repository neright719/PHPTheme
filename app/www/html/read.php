<div class="table" id="read">
    <div class="table_head">
        <div class="table_row">
            <span class="column_id">ID</span>
            <span class="column_mail">メールアドレス</span>
            <span class="column_created_at">作成日時</span>
            <span class="column_updated_at">更新日時</span>
            <span class="column_update">　</span>
            <span class="column_delete">　</span>
        </div>
    </div>
    <div class="table_body">
        <?php foreach ($data["records"] as $record) :?>
        <div class="table_row">
            <span class="column_id"><?= $record["id"]; ?></span>
            <span class="column_mail"><?= $record["email"]; ?></span>
            <span class="column_created_at"><?= $record["created_at"]; ?></span>
            <span class="column_updated_at"><?= $record["updated_at"]; ?></span>
            <span class="column_update">
                <a class="update_btn" 
                    data-id="<?= $record["id"]; ?>"
                    data-mail="<?= $record["email"]; ?>"
                    data-created_at="<?= $record["created_at"]; ?>"
                    data-updated_at="<?= $record["updated_at"]; ?>"
                    href="/?action=update&id=<?= $record["id"]; ?>">
                    <i class="fas fa-edit"></i>
                </a>
            </span>
            <span class="column_delete">
                <a class="delete_btn" data-csrf_token="<?= $csrf_token; ?>" data-id="<?= $record["id"]; ?>" href="/?action=delete&id=<?= $record["id"]; ?>">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </span>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="add"><a class="create_btn" href="/?action=create"><i class="fas fa-plus"></i>追加する</a></div>
</div>
