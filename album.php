<?php
$images = array();
$num = 4;

if ($handle = opendir('./album')) {
    while ($entry = readdir($handle)) {
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サークルサイト</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include('navbar.php'); ?>
    <h1>アルバム</h1>
    <?php
    if (count($images) > 0) {
        echo '<div class="row">';

        $images = array_chunk($images, $num);
        $page = 1;

        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $page = intval($_GET['page']);
            if (!isset($images[$page-1])) {
                $page = 1;
            }
        }

        foreach ($images[$page-1] as $img) {
            echo '<div class="col-3">';
            echo '<div class="card">';
            echo '<a href="./album/'.$img.'" target="_blank">
            <img src="./album/'.$img.'" class="img-fluid"></a>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';

        echo '<nav><ul class="pagination">';
        for ($i = 1; $i <= count($images); $i++) {
            echo '<li class="page-item"><a class="page-link" href="album.php?page='.$i.'">'.$i.'</a></li>';
        }
        echo '</ul></nav>';
    } else {
        echo '<div class="alert alert-dark" role="alert">画像はまだありません</div>';
    }
    ?>
</body>
</html>