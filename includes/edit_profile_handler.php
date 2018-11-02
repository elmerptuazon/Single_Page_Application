<?php

include '..//resource/config.php';

$username = mysqli_real_escape_string($conn, $_GET['username']);

$login = new DbConnection();

$login->edit_profile_handler($username);