<?php

include '..//resource/config.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$login = new DbConnection();

$login->loginhandler($username, $password);