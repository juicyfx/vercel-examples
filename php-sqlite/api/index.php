<?php

$db = new SQLite3('/tmp/db.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

$db->query('CREATE TABLE IF NOT EXISTS "visits" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "url" VARCHAR,
    "time" DATETIME
)');

$statement = $db->prepare('INSERT INTO "visits" ("url", "time") VALUES (:url, :time)');
$statement->bindValue(':url', ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? 'https') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$statement->bindValue(':time', date('Y-m-d H:i:s'));
$statement->execute();

$visits = $db->querySingle('SELECT COUNT(id) FROM "visits"');

echo("User visits: $visits");

$db->close();
