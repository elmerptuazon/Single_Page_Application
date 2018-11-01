<?php

include '..//resource/config.php';

$access = new DbConnection();
define('CONN', $access->checkConnection());

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
			//hashing password
			$hashedpassword = password_hash($password, PASSWORD_DEFAULT);
			//insert new data
			$sql = "INSERT INTO teacher(fullname, username, password) VALUES('$fullname', '$username', '$hashedpassword')";
			mysqli_query($conn, $sql);
			echo 'Registration Successful';
			exit();
		}
	}
