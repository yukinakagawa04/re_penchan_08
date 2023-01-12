<?php
// // ログイン済みかチェック
// if (isset($_SESSION['id'])) {
//     // ログイン済み ユーザーID取得
//     $userId = $_SESSION['id'];
// } else {
//     // ログインしていない場合はログイン画面へ
//     header('Location: 1_login_form.php');
// }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>確認画面！</title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://unpkg.com/sanitize.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="content">
        WELCOME to AQUALAND
        <img src=".//img/bg.jpg" width="530" height="auto">
    </div>
    <div class="content">
        <div class="control">
            <br>
            <a href="3_profile_display.php" class="back-btn">プロフィール設定</a>
            <a href="4_cancel_form.php" class="back-btn">サービスを解約する</a>
            <div class="clear"></div>
        </div>
    </div>

</body>