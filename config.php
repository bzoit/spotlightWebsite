<?php
    const USER = 'root';
    const PASSWORD = '';
    const HOST = 'localhost';
    const DATABASE = 'spotlight';
    try {
        $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    } catch (PDOException $e) {
        exit("There was a problem connecting to the servers. Please try again later." . $e);
    }
?>