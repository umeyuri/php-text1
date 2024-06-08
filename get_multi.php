<?php
$params = $_GET;
foreach ($params as $key => $param) {
    echo $key . 'は'. $param . '<br>';
}