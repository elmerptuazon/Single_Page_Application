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
}
