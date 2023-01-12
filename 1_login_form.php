<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>アカウント作成</title>
    <link href="https://unpkg.com/sanitize.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="content">
        <h1>ログインページ</h1>
        <p>当サービスをご利用するために、メールアドレスとパスワードを入力してください。</p>
        <br>
        <form action="1_login.php" method="POST" class="textcenter">
            <div>
                <label>
                    メールアドレス：
                    <input type="text" name="email" required>
                </label>
            </div>
            <div>
                <label>
                    パスワード：
                    <input type="password" name="password" required>
                </label>
            </div>
            <input type="submit" value="ログイン" class="btn">
        </form>
    </div>
</body>

</html>