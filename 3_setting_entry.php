<?php
require("./1_dbconnect.php");
session_start();

if (!empty($_POST)) {
    // エラー項目の確認
    if ($_POST['name'] == '') {
        $error['name'] = 'blank';
    }
    if ($_POST['email'] == '') {
        $error['email'] = 'blank';
    }
    if (strlen($_POST['password']) < 4) {
        $error['password'] = 'length';
    }
    if ($_POST['password'] == '') {
        $error['password'] = 'blank';
    }
    $fileName = $_FILES['image']['name'];
    if (!empty($fileName)) {
        $ext = substr($fileName, -3);
        if ($ext != 'jpg' && $ext != 'gif' && $ext != 'jpeg') {
            $error['image'] = 'type';
        }
    }

    if (empty($error)) {
        // 画像をアップロードする
        $image = date('YmdHis') . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../08_php03_loginform/img/' . $image);

        $_SESSION['join'] = $_POST;
        $_SESSION['join']['image'] = $image;

        header('Location: 3_setting_entry.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>確認画面</title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://unpkg.com/sanitize.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="content">
        <form action="3_setting_entry.php" method="POST">
            <div class="control">
                <label for="name">プロフィール写真</label>
                <input type="file" name="image" size="35" value="test" />
                <?php if ($error['image'] == 'type'): ?>
                    <p class="error">* 写真などは「.gif」「.jpg」「.jpeg」の画像を指定してください</p>
                <?php endif; ?>
                <?php if (!empty($error)): ?>
                    <p class="error">* 画像を再度アップロードしてください</p>
                <?php endif; ?>
            </div>
            <div class="control">
                <label for="name">ユーザー名</label>
                <input id="email" type="name" size="35" class="input_btn">
                <?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES); ?>

                </dd>
            </div>
            <div class="control">
                <label for="email">メールアドレス</label>
                <input id="email" type="email" name="email" size="35" class="input_btn">
                <?php echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES); ?>

            </div>
            <div class="control">
                <a href="3_profile_display.php" class="back-btn">戻る</a>
                <a href="3_setting_check.php" class="back-btn">登録内容を変更する</a>
                <div class="clear"></div>
            </div>
        </form>
    </div>
</body>

</html>