<?php


$host = 'localhost';
$db = 'tina';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
