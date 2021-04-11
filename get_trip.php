<?php

require_once 'config.php';

$trip_id = $_GET['id'];

$sql = "SELECT * FROM trips
        WHERE trips.id = :id";
$stmt = $conn->prepare( $sql );
$stmt->execute([
    'id'    => $trip_id,
]);

$trip = $stmt->fetch(PDO::FETCH_OBJ);


$stmt = $conn->prepare( "SELECT * FROM logs WHERE trip_id = :trip_id" );
$stmt->execute([
    'trip_id'  => $trip_id
]);
$logs = $stmt->fetchAll(PDO::FETCH_OBJ);

$res = [
    'trip'      => $trip,
    'logs'      => $logs
    // 'distance'  => $distance
];

print_r(json_encode( $res ));
die();
