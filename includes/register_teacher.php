<?php

include '..//resource/config.php';

$getClass = new DbConnection();

$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if(empty($fullname) || empty($username) || empty($password)) {
	echo 'Please complete all details';
	exit();
}
else {
	$sql = "SELECT * FROM teacher WHERE username='$username'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0) {
		echo 'Username already taken';
		exit();
	}
	else {
		//insert new data
		$sql = "INSERT INTO teacher(fullname, username, password) VALUES('$fullname', '$username', '$password')";
		mysqli_query($conn, $sql);
		echo 'Registration Successful';
		exit();
	}
}
