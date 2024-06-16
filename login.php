<?php
session_start(); //セッション開始

if (isset($_SESSION['id'])) {
    header('Location: index.php');
} else if (isset($_POST['name']) && isset($_POST['password'])) {
    //　DB接続
    $dsn = 'mysql:host=localhost;dbname=tennis;charset=utf8';//data source name
    $user = 'root';
    $password = 'root';

    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = $db->prepare("SELECT * FROM users where name=:name AND password=:pass");
        $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
        $stmt->bindParam(':pass', hash("sha256", $_POST['password']), PDO::PARAM_STR);
        $stmt->execute();

        if ($row = $stmt->fetch()) {
            // DBにユーザーが存在していたら
            session_regenerate_id(true);//セッションidを再生成
            $_SESSION['id'] = $row['id'];//セッションに保存

            header('Location: index.php');
            exit();
        } else {
            header('Location:login.php');
            exit();
        }
    } catch (PDOException $e) {
        exit('エラー:' . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サークルサイト</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style type="text/css">
        form {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
            text-align: center;
        }
        #name {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        #password {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
    </style>
</head>
<body>
    <main role="main" class="container" style="padding:60px 15px 0">
        <div>
            <form method="post" action="login.php">
                <h1>サークルサイト</h1>
                <label class="sr-only">ユーザー名</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="ユーザー名">
                <label class="sr-only">パスワード</label>
                <input type="text" id="password" name="password" class="form-control" placeholder="パスワード">
                <input type="submit" class="btn btn-primary btn-block" value="ログイン">
            </form>
        </div>
    </main>
</body>
</html>