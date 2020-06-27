<?php

$filename = $_SERVER['SCRIPT_NAME'] ?? '/index.php';

if ($filename === '/index.php') {
    echo require __DIR__ . '/public/index.html';
} else {
    echo require __DIR__ . '/public/' . $filename;
}
