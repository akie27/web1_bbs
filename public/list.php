<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="../common/style.css">
</head>
<body>
    <?php require('../common/header.php'); ?>
    
    <p class="title">Web1ちゃんねる</p>

    <form action="list.php" method="POST" class="form_items list_form">

        <div class="list_items">
            <div class="list_titles">
                <?php foreach($bbsData as $column): ?>
                <span><?php echo $column['post_id']; ?></span>
                <span><?php echo $column['post_name']; ?></span>
                <p><?php echo $column['created_at']; ?></p>
            </div>
            <p class="list_msg"><?php echo $column['message']; ?></p>
            <div class="reply_items">
                <div class="reply_titles">
                    <span class="reply_arrow">↪️</span>
                    <div class="flex_column">
                        <div class="list_titles">
                            <span><?php echo $column['post_name']; ?></span>
                            <p><?php echo $column['created_at']; ?></p>
                        </div>
                        <p><?php echo $column['message']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <input type="text" name="reply_msg" placeholder="返信メッセージ" class="reply_msg">
            <input type="submit" name="reply_btn" value="返信" class="btn list_btn reply_btn">
            <a href="http://" class="delete_url">この投稿を削除する</a>
        </div>

        <div class="post_msg">
            <input type="text" name="posy_msg" placeholder="投稿メッセージ" class="post_msg">
            <input type="submit" name="post_btn" value="投稿" class="btn list_btn post_btn">
        </div>

    </form>

    <?php require('../common/footer.php'); ?>
</body>
</html>