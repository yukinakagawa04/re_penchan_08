<?php

require("./1_dbconnect.php");
session_start();

$sql = 'SELECT * FROM todo_table WHERE deleted_at IS NULL ORDER BY deadline ASC';


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

    // if (empty($error)) {
    //     // 画像をアップロードする
    //     $image = date('YmdHis') . $_FILES['image']['name'];
    //     move_uploaded_file($_FILES['image']['tmp_name'], '../08_php03_loginform/img/' . $image);

    //     $_SESSION['join'] = $_POST;
    //     $_SESSION['join']['image'] = $image;



    header('Location: 3_setting_entry.php');
    exit();
}




if (!empty($_POST['check'])) {
    // パスワードを暗号化
    $hash = password_hash($_SESSION['join']['password'], PASSWORD_BCRYPT);

    // 入力情報をデータベースに登録
    $statement = $db->prepare("INSERT INTO members SET name=?, email=?, password=?");
    $statement->execute(
        array(
            $_SESSION['join']['img'],
            $_SESSION['join']['name'],
            $_SESSION['join']['email'],

            $hash
        )
    );

}

// 画像ファイルのリストを格納する配列
$images = array();
// 画像フォルダから画像のファイル名を読み込む
if ($handle = opendir('./img')) {
    // ファイル名を取得し、変数$entryに格納。
    // 取得できている限りループし続け、全て読み込んでループを抜ける
    while ($entry = readdir($handle)) {
        // 「.」かつ「..」ではない場合、ファイル名を配列に追加
        // サーバ上でファイル名の一覧を取得すると現在地のディレクトリと１階層上のディレクトリも取得するため
        // 画像ファイルだけ取得したいために除外する構文としている
        if ($entry != "." && $entry != "..") {
            $images[] = $entry;
        }
    }
    closedir($handle);
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
                        <?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES); ?>
                    </span></p>
            </div>

            <div class="control">
                <p>メールアドレス</p>
                <p><span class="fas fa-angle-double-right"></span> <span class="check-info">
                        <?php echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES); ?>
                    </span></p>
            </div>

            <a href="3_setting_entry.php" class="btn">登録内容を変更する</a>
            <div class="clear"></div>
        </form>
    </div>

</body>