<?php

include '../..//resource/config.php';

$username = mysqli_real_escape_string($conn, $_GET['username']);

$arr = array();
$sql = "SELECT fullname, username FROM student WHERE teacher='$username'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
	array_push($arr, $row['fullname'], $row['username']);
}

 echo json_encode($arr);
