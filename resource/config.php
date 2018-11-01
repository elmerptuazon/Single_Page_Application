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
}
