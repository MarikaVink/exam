<?php
	//we need functions for dealing with session
	require_once("functions.php");
	
	//RESTRICTION - LOGGED IN
	if(!isset($_SESSION["user_id"])){
		//redirect not logged in user to login page
			header("Location: login.php");
	}
	
	
	//?logout is in the url
	if(isset($_GET["logout"])){
		//delete the session
		session_destroy();
		
		header("Location:homeapp.php");
	}
	
		
	
	
?>

<h2>Welcome <?php echo $_SESSION["name"];?> </h2>

<a href="?logout=1" > Logout</a>;
















