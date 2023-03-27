<?php

$file = $_GET['file'] ?? null;

if (!$file) {
    die('No ?file=<file> given');
}

echo file_get_contents($file);
