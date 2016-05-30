<?php require_once("homeheader.php"); ?>
	<?php require_once("functions.php");
	

	
	//RESTRICTION - LOGGED IN
	if(!isset($_SESSION["user_id"])){
		//redirect user to restricted page
			header("Location: login.php");
	}


//?logout is in the url
	if(isset($_GET["logout"])){
		//delete the session
		session_destroy();
		
		header("Location:table2.php");
	}	?>
<?php


//getting our configuration
require_once("../../config.php");

//create connection_aborted
$mysql = new mysqli("localhost",$db_username, $db_password,"webpr2016_marvin");

/*
IF THERE IS ?DELETE=ROW_ID in the url
*/
if(isset($_GET["delete"])){
	
	echo "Deleting row with id:".$_GET["delete"];
	
	$stmt = $mysql->prepare("UPDATE Phonebook SET deleted=NOW() WHERE id = ?");
	
	echo $mysql->error;
	
	//replace the ?
	$stmt->bind_param("i", $_GET["delete"]);
	
	if($stmt->execute()){
		echo "deleted successfully";
	}else{
		echo $stmt->error;
	}
	
	//closes the statement, so others can use connection
	$stmt->close();
}


//SQL sentence
$stmt = $mysql->prepare("SELECT id, first_name, last_name, phone, email,
 created FROM Phonebook WHERE deleted IS NULL ORDER BY id DESC LIMIT 10");

//if error in sentence
echo $mysql->error;

//variables for data for each row we will get
$stmt->bind_result ($id, $first_name, $last_name, $phone, $email, $created);

//query
$stmt->execute();

$table2_html = "";

$table2_html .="<table class='table table-striped'>";
	$table2_html .="<tr>";
$table2_html .="<th>ID</th>";
$table2_html .="<th>First name</th>";
$table2_html .="<th>Last name</th>";
$table2_html .="<th>Phone number</th>";
$table2_html .="<th>Email address</th>";
$table2_html .="<th>Created</th>";
$table2_html .="<th>Delete?</th>";
$table2_html .="</tr>";
		
//GET RESULT
//we have multiple rows
while($stmt->fetch()){
	
	//DO SOMETHING FOR EACH ROW
	//echo $id." ".$message."<br>";
		$table2_html .="<tr>";//start new row
$table2_html .="<td>".$id."</td>";
$table2_html .="<td>".$first_name."</td>";
$table2_html .="<td>".$last_name."</td>";
$table2_html .="<td>".$phone."</td>";
$table2_html .="<td>".$email."</td>";
$table2_html .="<td>".$created."</td>";
$table2_html .="<td><a class='btn btn-danger' href='?delete=".$id."'>Delete</a></td>";
$table2_html .="</tr>"; //end row
	
	
}
$table2_html .="</table>";


?>

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
			
			<li >
				<a href="homeapp.php">
					New contact
				</a>
			</li>
			
			
			<li class="active">
				<a href="table2.php">
					All contacts
				</a>
			</li>
			
		  </ul> 
		  
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">

		<h1> My Contacts </h1>
		
		<?php echo $table2_html; ?>
		
		
		</div>

		 <a href="?logout" align="center"> Logout</a>;
  </body>
 
</html>
















