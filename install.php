<?php
//Создадим пустую базу
$conf = require_once __DIR__.'/conf/index.php';
print "\n Create database in ".$conf["db"]."\n-----------\n";
$db = new SQLite3( $conf["db"] );

$db->exec('
CREATE TABLE `Calcs` (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT,
    `name`	TEXT NOT NULL,
	`body`	TEXT NOT NULL
);
');

$db->exec('
CREATE TABLE `CalcResults` (
	`calc_id`	INTEGER NOT NULL,
	`secret_code`	NUMERIC NOT NULL
);
');
