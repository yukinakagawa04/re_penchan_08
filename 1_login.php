<?php

include('functions.php');
$pdo = connect_to_db();


// フォームが送信された場合
// if (!empty($_POST)) {
//     // フォーム入力値を取得
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     // データベース接続は別ファイルで行っっている前提

//     // データーベースから入力されたユーザーを検索
//     $sql =
//         'SELECT
//     *
//     FROM
//         members
//     WHERE
//         email= :email';
//     $stmt = $dbh->prepare($sql);
//     $stmt->bindValue(':email', $email);
//     // $stmt->bindValue(':password', sha1($password));
//     $stmt->execute();

//     $user = $stmt->fetch();


$stmt = $pdo->prepare('SELECT * FROM members WHERE email = :email');

$stmt->execute(array(':email' => $_POST['email']));

$result = $stmt->fetch(PDO::FETCH_ASSOC);


if (password_verify($_POST['password'], $result['password'])) {
    header('Location: 2_top.php');
} else {
    // ログインNG
    $error['login'] = "failed";
}

// // ユーザーが見つかればログインOK
// if ($user) {
//     // $_SESSIONにログインしたユーザーIDを保持
//     $_SESSION['id'] = $user['id'];

//     // メールアドレスを記憶させる場合
//     if ($_POST['save'] === 'ON') {
//         // クッキーにメールアドレスを保持
//         setcookie('email', $email, time() + 60 * 60 * 24 * 14);
//     }

// ログイン後の画面に遷移




?>