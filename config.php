<?php
    define('USER', 'wilsont');
    define('PASSWORD', 'B0zzMan137!');
    define('HOST', '68.81.62.164');
    define('DATABASE', 'spotlight');
    try {
        $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    } catch (PDOException $e) {
        exit("There was a problem connecting to the servers. Please try again later." . $e);
    }
?>