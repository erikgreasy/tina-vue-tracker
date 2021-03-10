<?php

require_once 'config.php';

$sql = "SELECT * FROM logs";
$results = $conn->query($sql, PDO::FETCH_ASSOC)->fetchAll();
print_r(json_encode($results));


exit;