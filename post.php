<?php
    $name = $_POST['name'];
    
    $gender = $_POST['gender'];
    if ($gender === 'man') {
        $gender = '男性';
    } else if ($gender === 'woman'){
        $gender = '女性';
    }

    $temp_star = intval($_POST['star']);
    $star = '';
    if ($temp_star > 1 || $temp_star <= 5) {
        for ($i = 0; $i < $temp_star; $i++) {
            $star .= '★'; 
        }
        for (; $i < 5; $i++) {
            $star .= '☆';
        }
    }
    $other = $_POST['other'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>アンケート結果</h1>
    <p>お名前：<?php echo $name; ?></p>
    <p>性別：<?php echo $gender; ?></p>
    <p>評価：<?php echo $star; ?></p>
    <p>意見：<?php echo $other; ?></p>
</body>
</html>