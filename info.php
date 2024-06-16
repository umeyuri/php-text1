<?php
include './includes/login.php';
// $fp = fopen('./info.txt', 'r');
// $line = [];
// if ($fp) {
//     $text = fgets($fp);
//     while ($text !== false) {
//         $line[] = $text;
//         $text = fgets($fp);
//     }
//     fclose($fp);
// }
$line = file('./info.txt');

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php include('navbar.php'); ?>
    <main role="main" class="container" style="padding: 60px 15px 0">
        <div>
            <h1>お知らせ</h1>
            <?php foreach ($line as $key => $text) {
                if ($key === 0) {
                    echo '<h2>' . $text . '</h2>';
                } else {
                    echo $text . "<br>";
                }

            }?>
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