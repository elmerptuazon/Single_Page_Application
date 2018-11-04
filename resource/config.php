<?php

define("DBUSER", "root");
define("DBPWD", "");
define("DBHOST", "localhost");
define("DBNAME", "school");

$conn = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);

Class DbConnection {

	function checkConnection() {
		$conn = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);
		if($conn) {
			return 'Connected';
		}
		else {
			return 'Invalid';
		}
	}

	function loginhandler($username, $password) {
		$conn = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);
		if(empty($username) || empty($password)) {
			echo 'Please complete everything';
			exit();
		}
		else {
			$sql = "SELECT username, password FROM teacher WHERE username='$username'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck < 1) {
				echo 'Please go to "Register Teacher"';
				exit();
			}
			else {
				if($row = mysqli_fetch_assoc($result)) {
					if($row['password'] !== $password) {
						echo 'Incorrect Details';
						exit();
					}
					else {
						echo 'Welcome ' . $username;
					}
				}
			}
		}
	}

	function edit_profile_handler($username) {
		$conn = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);
		$arr = array();
		$sql = "SELECT fullname, username, password FROM teacher WHERE username='$username'";
		$result = mysqli_query($conn, $sql);
		if($row = mysqli_fetch_assoc($result)) {
			$arr = array(
				'fullname' => $row['fullname'],
				'username' => $row['username'],
				'password' => $row['password']
			);
			echo json_encode($arr);
		}
	}

	function updated_profile($fullname, $username, $password) {
		
		$conn = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);
		$sql = "UPDATE teacher SET fullname='$fullname', username='$username', password='$password' WHERE username='$username'";
		$student = "UPDATE student SET fullname='$fullname', username='$username', password='$password' WHERE username='$username'";
		$result = mysqli_query($conn, $sql);
		$res = mysqli_query($conn, $student);
		$sel = "SELECT * FROM student WHERE username='$username'";
		$selsql = mysqli_query($conn, $sel);
		$resultCheck = mysqli_num_rows($selsql);
		if($resultCheck >= 1) {
			echo 'Updated Student Successful';
		}		
		elseif($result) {
			mysqli_query($conn, $sql);
			echo 'Updated Successful';
		}
	}
}
