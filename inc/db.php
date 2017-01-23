<?php

$dsn = "mysql:host=$ms_host;dbname=$ms_db;charset=$ms_charset";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO($dsn, $ms_user, $ms_pass, $opt);