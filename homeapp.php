<style>
body {
	color:rgb(41,91,81);
	background-color:rgb(201,245,225);
	font-family:sans-serif;
	font-size:10pt;
	text-align:center;
	margin:100px;}
	}
h2   {
	font-size:26pt;
	color:#54b352; 
	font-family:sans-serif;
	text-align:center;}
p    {
	color:green; 
	font-family:sans-serif; 
	font-size:8pt;
	text-align:center;}
	
	

</style>

	<?php require_once("functions.php");
	
	 ?>

<?php require_once("homeheader.php"); ?>

		<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		
		  <ul class="nav navbar-nav">
			
			<li class="active">
				<a href="homeapp.php">
					New contact
				</a>
			</li>
			
			
			<li>
				<a href="table2.php">
					All contacts
				</a>
			</li>
			
		  </ul> 
		  
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">
	
<h2> Got phone?</h2>

<p>Yellow pages phonebook</p>

<form method="get"
	<label for="first_name"> First Name:</label>
	<input type="text" name="first_name" min="1" max="130" ><br>

 
 	
<?php
	//required another php file
	require_once("../../config.php");


	$everything_was_okay = true;

	//check if there is variable in the URL
	
	
	//for First name field:
	if(isset($_GET["first_name"])){
		
		//only if there is first name typed in the URL
		//echo "name check!";
		
		//if it's empty
		if(empty($_GET["first_name"])){
			//it is empty
			echo "Please give a name!";
		}else{
				//its not empty
				echo "Name: ".$_GET["first_name"]."<br>"; 
		}
		
	}else{
		//echo "Please type in the name!";
		$everything_was_okay = false;
	}
?>
<br><br>
		

	<label for="last_name"> Last name:</label>
	<input type="text" name="last_name" min="1" max="130" ><br>

<?php	

	
		//required another php file
	require_once("../../config.php");


	$everything_was_okay = true;
	
	if(isset($_GET["last_name"])){	
		
		if(empty($_GET["last_name"])){
			echo "Please give a last name!";
		}else{
				//its not empty
				echo "Name: ".$_GET["last_name"]."<br>"; 
		}
		
	}else{
		//echo "Please type in the last name!";
		$everything_was_okay = false;
	}
?>
<br><br>

	<label for="phone"> Phone number:</label>
	<input type="number" name="phone" min="1" max="999999999999999"><br>

<?php	

	if(isset($_GET["phone"])){
		
		if(empty($_GET["phone"])){
			//it is empty
			echo "Please enter phone number!";
			$everything_was_okay = false;
	}else{
			//its not empty
			echo "Phone number: ".$_GET["phone"]."<br>";
		}
		
	}else{
		//echo "Please type in phone number!";
		$everything_was_okay = false;
	}
	
?>
<br><br>

	<label for="email"> Email:</label>
	<input type="text" name="email" min="5" max="600"><br><br>

<?php	
	
	if(isset($_GET["email"])){
		
		//if it's empty
		if(empty($_GET["email"])){
			//it is empty
			echo "Please type email";
			$everything_was_okay = false;
	}else{
			//its not empty
			echo "Email: ".$_GET["email"]."<br>";
		}
		
	}else{
		//echo "there is no email typed";
		$everything_was_okay = false;
	}
	
?>

	<br><input type="submit" class='btn btn-primary' value="Add to contacts"> 
</form>
<?php
	if($everything_was_okay == true){
		
		echo "Saving to database . . .";
		
		//connection with username and password
		//access username from config
		//echo $db_username;
		
		//1 servername
		//username	
		//password
		//database
		$mysql = new mysqli("localhost",$db_username, $db_password,"webpr2016_marvin");
		
		$stmt = $mysql->prepare("INSERT INTO Phonebook(first_name, last_name, phone, email) VALUES (?,?,?,?)");
		
		//echo error
		echo $mysql->error;
		
		
		//WE ARE REPLACING QUESTION MARKS
		//s - string, date or smth that is based on characters and 
		//i - integer, number_format
		//d - decimal, float
		
		$stmt->bind_param("ssis",$_GET["first_name"],$_GET["last_name"],$_GET["phone"],$_GET["email"] );
		
		//save
		if($stmt->execute()){
			echo "saved successfully";
		}else{
			echo $stmt->error;}
	}
	
?>
<html><a href="login.php" > Login</a></html>
