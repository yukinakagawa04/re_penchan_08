<?php
// データ受け取り
$id = $_GET['id'];

// DB接続
include('functions.php');

// SQL実行

$pdo = connect_to_db();
$sql = 'UPDATE todo_table SET deleted_at=now() WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:todo_read.php");
exit();