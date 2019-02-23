<?php
	Class config {

		public function dbconnect(){
			$servername = "localhost";
			$username 	= "root";
			$password 	= "";
			$dbname		= "bhousefinder";
			// connect to database
			$conn = new mysqli($servername, $username, $password,$dbname);
			// Check connection
			if ($conn->connect_error) {
			    // die("Connection failed: " . $conn->connect_error);
					header('Location: dberror.php');
			}
			// return the database connection
			return $conn;
		}
	}
?>
