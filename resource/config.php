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
			echo 'Please enter something';
			exit();
		}
		else {
			$sql = "SELECT * FROM teacher WHERE username='$username'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck < 1) {
				echo 'Please go to "Register Teacher"';
			}
		}
	}
}
