<?php
include 'resource/config.php';

$conn = new DbConnection();

$arr = array(
	'getconn' => $conn->getConnection()
);

echo json_encode($arr);

?>