<?php
include './includes/login.php';
$msg = null;
$alert = null;

if (isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
    $old_name = $_FILES['image']['tmp_name'];//テンポラリフォルダにアップロードされたファイル名
    $new_name = date("YmdHis");
    $new_name .= mt_rand();
    $size = getimagesize($_FILES['image']['tmp_name']);
    switch ($size[2]) {
        case IMAGETYPE_JPEG:
            $new_name .= '.jpeg';
            break;
        case IMAGETYPE_GIF:
            $new_name .= '.gif';
            break;
        case IMAGETYPE_PNG:
            $new_name .= '.png';
            break;
        default:
            header('Location: upload.php');
            exit();
    }
    if (move_uploaded_file($old_name, 'album/' . $new_name)) {//テンポラリフォルダからalbum/に移動
        $msg = 'アップロードしました';
        $alert = 'success';
    } else {
        $msg = 'アップロードできませんでした';
        $alert = 'denger';
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
</head>
<body>
    <?php include('navbar.php'); ?>
    <main role="main" class="container" style="padding: 60px 15px 0">
        <div>
            <h1>画像アップロード</h1>
            <?php
            if ($msg) {
                echo '<div class="alert alert-'.$alert.'" role="alert">'.$msg.'</div>';
            }
            ?>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="file" name="image" class="form-control-file">
                </div>
                <input type="submit" value="アップロード" class="btn btn-primary">
            </form>
        </div>
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