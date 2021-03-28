<?php

require_once 'config.php';

$sql = "SELECT * FROM trips ORDER BY trips.id DESC";
$stmt = $conn->query( $sql );
$trips = $stmt->fetchAll( PDO::FETCH_OBJ );

print_r( json_encode( $trips ) );
die();