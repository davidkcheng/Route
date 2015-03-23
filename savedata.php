<?php

$data = $_POST['data'];
$f = fopen('files/file.txt', 'w+');
fwrite($f, $data);
fclose($f);
?>