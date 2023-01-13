<?php

include('functions.php');
$pdo = connect_to_db();

$stmt = $pdo->prepare('SELECT * FROM members WHERE email = :email');

$stmt->execute(array(':email' => $_POST['email']));

$result = $stmt->fetch(PDO::FETCH_ASSOC);


if (password_verify($_POST['password'], $result['password'])) {
    header('Location: 2_top.php');
} else {
    // ログインNG
    $error['login'] = "failed";
}

?>