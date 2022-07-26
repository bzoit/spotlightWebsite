<?php
    function generateRandomString($connection) {
        $token = substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(9/strlen($x)) )),1,9);
        $query = $connection->prepare("SELECT * FROM users WHERE token=:token");
        $query->bindParam("token",$token);
        $query->execute();
        $rows = $query->rowCount();
        while ($rows > 0) {
            $token = substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(9/strlen($x)) )),1,9);
            $query = $connection->prepare("SELECT * FROM users WHERE token=:token");
            $query->bindParam("token",$token);
            $rows = $query->rowCount();
        }
        return $token;
    }
?>