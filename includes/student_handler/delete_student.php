<?php

include '../..//resource/config.php';

$getClass = new DbConnection();

$username = mysqli_real_escape_string($conn, $_POST['username']);

if(empty($username)) {
	echo 'Please complete all details';
	exit();
}
else {
	$sql = "SELECT username FROM student WHERE username='$username'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck == 0) {
		echo 'Username does not exist';
		exit();
	}
	else {
		//delete data
		$sql = "DELETE FROM student WHERE username='$username'";
		mysqli_query($conn, $sql);
		echo 'Deleted a student';
		exit();
	}
}
