<?php
include './includes/login.php';
// データを受け取る
$name = $_POST['name'];
$title = $_POST['title'];
$body = $_POST['body'];
$pass = $_POST['pass'];

$token = $_POST['token']; //csrf対策
if ($token != hash("sha256", session_id())) {
    header('Location:bbs.php');
    exit();
}

//　必須項目が空の場合
if ($name == '' || $body == '') {
    header("Location: bbs.php"); //一覧へ移動する
    exit();
}

// パスワードが４桁でない場合
if (!preg_match("/^[0-9]{4}$/", $pass)) {
    header("Location:bbs.php");
    exit();
}

// クッキーを発行して保存させる
setcookie('name', $name, time() + 60*60*24*30);

//　DB接続
$dsn = 'mysql:host=localhost;dbname=tennis;charset=utf8';//data source name
$user = 'root';
$password = 'root';

try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmt = $db->prepare("
        INSERT INTO bbs (name, title, body, date, pass)
        VALUES (:name, :title, :body, now(), :pass)
    ");

    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':body', $body, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);

    $stmt->execute();

    header('Location: bbs.php');
    exit();
} catch (PDOException $e){
    exit('エラー:' . $e->getMessage());
}
?>