<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: ../login.php');
}
?>

<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("../connection.php");

if(isset($_POST['Submit2'])) {	
	$name = $_POST['cusname'];
	$address = $_POST['cusaddress'];
	$phone = $_POST['cusphone'];
	// checking empty fields
	if(empty($name) || empty($address) || empty($phone)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($address)) {
			echo "<font color='red'>Address field is empty.</font><br/>";
		}
		
		if(empty($phone)) {
			echo "<font color='red'>Phone field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($link, "INSERT INTO customers(cusname, cusaddress, cusphone) VALUES('$name','$address','$phone')");
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='customerpage.php'>View Result</a>";
	}
}
?>
</body>
</html>
