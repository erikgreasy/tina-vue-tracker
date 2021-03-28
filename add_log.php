<?php

require_once 'config.php';

$_POST = json_decode(file_get_contents("php://input"),true);

if( isset( $_POST['trip_id'] ) ) {
    $trip_id = $_POST['trip_id'];
} else {
    die('trip id not set');
}


if( isset( $_POST['speed'] ) ) {
    $speed = $_POST['speed'];
}


if( isset( $_POST['distance'] ) ) {
    $distance = $_POST['distance'];
}

if( isset( $_POST['timepassed'] ) ) {
    $timepassed = $_POST['timepassed'];
} else {
    die('timepassed not set');
}


$sql = "INSERT INTO logs (trip_id, speed, distance, timepassed) VALUES (:trip_id, :speed, :distance, :timepassed)";
$stmt = $conn->prepare( $sql );

try {

    $stmt->execute( [
        'trip_id'       => $trip_id,
        'speed'         => $speed,
        'distance'      => $distance,
        'timepassed'    => $timepassed
    ] );

    echo 'success log';
} catch( PDOException $e ) {
    echo $e;
}

die();