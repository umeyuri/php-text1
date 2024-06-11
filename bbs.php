<?php
$num = 10;

//　DB接続
$dsn = 'mysql:host=localhost;dbname=tennis;charset=utf8';//data source name
$user = 'root';
$password = 'root';

$page = 1;
if (isset($_GET['page']) && $_GET['page'] > 1) {
    $page = intval($_GET['page']);
}


try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $db->prepare("SELECT * FROM bbs ORDER BY date DESC LIMIT :page, :num");
    $page = ($page-1) * $num;
    $stmt->bindParam(':page', $page, PDO::PARAM_INT);
    $stmt->bindParam(':num', $num, PDO::PARAM_INT);
    
    $stmt->execute();

} catch(PDOException $e) {
    exit("エラー:" . $e->getMessage());
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
</head>
<body>
    <?php include('navbar.php'); ?>
    <main role="main" class="container" style="padding: 60px 15px 0">
        <div>
            <h1>掲示板</h1>
            <form method="post" action="write.php">
                <div class="form-group">
                    <label>タイトル</label>
                    <input type="text" name="title" class="form-control"> 
                </div>
                <div class="form-group">
                    <label>名前</label>
                    <input type="text" name="name" class="form-control"> 
                </div>
                <div class="form-group">
                <label>テキスト</label>
                    <textarea name="body" class="form-control" row="5"></textarea>
                </div>
                <div class="form-group">
                    <label>削除パスワード（数字４桁）</label>
                    <input type="text" name="pass" class="form-control"> 
                </div>
                <input type="submit" class="btn btn-primary" value="書き込む">
            </form>
            <hr>
            <?php while ($row = $stmt->fetch()): ?>
                <div class="card">
                    <div class="card-header"><?php echo $row['title'] ? $row['title']: '無題'; ?></div>
                    <div class="card-body">
                        <p class="card-text"><?php echo nl2br($row['body']) ?></p>
                    </div>
                    <div class="card-footer">
                        <form action="delete.php" method="post" class="form-inline">
                        <?php echo $row['name']; ?>
                        (<?php echo $row['date']; ?>)
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="pass" placeholder="削除パスワード" class="form-control">
                        <input type="submit" value="削除" class="btn btn-secondary">
                        </form>
                    </div>
                </div>
                <hr>
            <?php endwhile; ?>

            <?php
            try {
                $stmt = $db->prepare("SELECT COUNT(*) FROM bbs");

                $stmt->execute();
            } catch (PDOException $e) {
                exit("エラー:" . $e->getMessage());
            }

            $comments = $stmt->fetchColumn();
            $max_page = ceil($comments / $num);

            if ($max_page >= 1) {
                echo '<nav><ul class="pagenation">';
                for ($i = 1; $i <= $max_page; $i++) {
                    echo '<li class="page-item"><a href="bbs.php?page='.$i.'">'.$i.'</a></li>';
                }
                echo '</ul></nav>';
            }
            ?>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
    crossorigin="anonymous"></script>
    <script>
        Window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>