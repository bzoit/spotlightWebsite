<?php
    define('USER', 'root');
    define('PASSWORD', '');
    define('HOST', '127.0.0.1');
    define('DATABASE', 'spotlight');
    try {
        $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    } catch (PDOException $e) {
        exit("There was a problem connecting to the servers. Please try again later." . $e);
    }
?>