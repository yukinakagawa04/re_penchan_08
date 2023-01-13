<?php
// 入力項目のチェック

if (
    !isset($_POST['todo']) || $_POST['todo'] === '' ||
    !isset($_POST['deadline']) || $_POST['deadline'] === '' ||
    !isset($_POST['id']) || $_POST['id'] === ''
) {
    exit('paramError');
}

// DB接続

$todo = $_POST['todo'];
$deadline = $_POST['deadline'];
$id = $_POST['id'];

// DB接続
$dbn = 'mysql:dbname=gs_f07_01;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
    $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

include('functions.php');
$pdo = connect_to_db();

$sql = 'UPDATE todo_table SET todo=:todo, deadline=:deadline, uploaded_at=now() WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:todo_read.php");
exit();

// SQL実行
