<?php

session_start();


if(isset($_POST["submit"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$mysqli = new mysqli("localhost","root","","unit_7");

	// Check connection
	if ($mysqli -> connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	  exit();
	}

	// Perform query
	if ($result = $mysqli -> query("SELECT * FROM users WHERE username='".$username."' AND password='".$password."'")) {

		if($result -> num_rows <= 0) {
			header("Location: login.html");
			exit();
		} else {
			$row = mysqli_fetch_array($result);
			$user_id  = $row["user_id"];
			$session_id = session_id();

			$_SESSION["user_id"] = $user_id;
			$_SESSION["session_id"] = $session_id;
			$time = time();

			$sql = "INSERT INTO login_sessions (user_id, session_id, last_access_time) VALUES ('".$user_id."', '".$session_id."', '".$time."')";

			$mysqli->query($sql);

			header("Location: admin.php");
			exit();

		}

	  
	  // Free result set
	  $result -> free_result();
	}

	$mysqli -> close();

}


?>