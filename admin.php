<?php

session_start();

$user_id = $_SESSION["user_id"];
$session_id = $_SESSION["session_id"];


$mysqli = new mysqli("localhost","root","","unit_7");

	// Check connection
	if ($mysqli -> connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	  exit();
	}

	// Perform query
	if ($result = $mysqli -> query("SELECT * FROM login_sessions WHERE user_id='".$user_id."' AND session_id='".$session_id."'")) {

		if($result -> num_rows <= 0) {
			header("Location: login.html");
			exit();
		} else {
			$row = mysqli_fetch_array($result);
			$login_id  = $row["login_id"];
			
			$time = time();

			$sql = "UPDATE login_sessions SET last_access_time='".$time."' WHERE login_id='".$login_id."'";

			$mysqli->query($sql);

			echo "<h1>Welcome Admin</h1>";
			

		}

	  
	  // Free result set
	  $result -> free_result();
	}

	$mysqli -> close();

?>