<?php
$fp = fopen('test.txt', 'a');
if ($fp) {
    fwrite($fp, "書き込みます\n");
    fclose($fp);
    echo '書き込みが終了しました';
}else {
    echo 'エラーが起きました';
}
// file_put_contents('text.txt', "書き込み\n")
?>