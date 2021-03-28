<?php

require_once 'config.php';

$trip_id = $_GET['id'];

$sql = "SELECT trips.start_time, AVG(logs.speed) as avg_speed, MAX(logs.timepassed) as time_passed FROM trips
LEFT JOIN logs ON trips.id = logs.trip_id
WHERE trips.id = :id";
$stmt = $conn->prepare( $sql );
$stmt->execute([
    'id'    => $trip_id,
]);

$trip = $stmt->fetch(PDO::FETCH_OBJ);


$stmt = $conn->prepare( "SELECT distance FROM logs WHERE trip_id = :trip_id" );
$stmt->execute([
    'trip_id'  => $trip_id
]);
$distance = $stmt->fetchAll(PDO::FETCH_OBJ);

$res = [
    'trip'      => $trip,
    'distance'  => $distance
];

print_r(json_encode( $res ));
die();
