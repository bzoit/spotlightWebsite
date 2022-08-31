<?php
    const USER = 'wilsont';
    const PASSWORD = 'B0zzMan137!';
    const HOST = '192.168.0.140';
    const DATABASE = 'spotlight';
    try {
        $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    } catch (PDOException $e) {
        exit("There was a problem connecting to the servers. Please try again later." . $e);
    }
?>