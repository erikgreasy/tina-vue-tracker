<?php


require_once 'config.php';


$sql = "INSERT INTO trips VALUES ()";

try {
    $conn->query($sql);
    echo $conn->lastInsertId();
} catch(PDOException $e) {
    echo $e;
}

die();