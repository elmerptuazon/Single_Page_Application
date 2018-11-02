<?php

include '..//resource/config.php';

$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$login = new DbConnection();

$login->updated_profile($fullname, $username, $password);