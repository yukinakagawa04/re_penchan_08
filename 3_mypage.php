<?php
session_start();
if (!$_SESSION['id'] > 0) {
    header('Location:1_login_form.php');
}
$login_name = $_SESSION['name'];

include('functions.php');
$pdo = connect_to_db();

$id = $row['id'];
$stmt = $pdo->prepare('SELECT * FROM members WHERE id = :id');
$stmt->execute(array(':id' => $_POST['id']));
// $stmt->execute(array(':name' => $_POST['name']));

$result = $stmt->fetch(PDO::FETCH_ASSOC);


$_SESSION['name'] = 'potepen';
$_SESSION['email'] = 'testtest@gmail.com'; //セッション変数に登録







?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>マイページ</title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://unpkg.com/sanitize.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="content">
        <form action="" method="POST">
            <input type="hidden" name="check" value="checked">
            <h1>入力情報の確認</h1>
            <p>ご入力情報に変更が必要な場合、下のボタンを押し、変更を行ってください。</p>
            <p>登録情報はあとから変更することもできます。</p>
            <?php if (!empty($error) && $error === "error"): ?>
                <p class="error">＊会員登録に失敗しました。</p>
            <?php endif ?>
            <hr>
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
                <p>ユーザー名</p>
                <p><span class="fas fa-angle-double-right"></span> <span class="check-info">
                        <?php echo $_SESSION['name']; ?>
                    </span></p>
            </div>

            <div class="control">
                <p>メールアドレス</p>
                <p><span class="fas fa-angle-double-right"></span> <span class="check-info">
                        <?php echo $_SESSION['email'] ?>
                    </span></p>
            </div>

            <a href="3_setting_entry.php" class="btn">登録内容を変更する</a>
            <div class="clear"></div>
        </form>
    </div>

</body>