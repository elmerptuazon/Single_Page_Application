<?php

include '../..//resource/config.php';

$getClass = new DbConnection();

$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$teacher = mysqli_real_escape_string($conn, $_POST['teacher']);

if(empty($fullname) || empty($username) || empty($password)) {
	echo 'Please complete all details';
	exit();
}
else {
	$sql = "SELECT * FROM student WHERE username='$username'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0) {
		echo 'Username already taken';
		exit();
	}
	else {
		//insert new data
		$sql = "INSERT INTO student(fullname, username, password, teacher) VALUES('$fullname', '$username', '$password', '$teacher')";
		mysqli_query($conn, $sql);
		echo 'Added a student';
		exit();
	}
}
