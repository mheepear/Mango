<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: ../login.php');
}
?>

<?php
//including the database connection file
include("../connection.php");

//getting id of the data from url
$id = $_GET['cusid'];

//deleting the row from table
$result=mysqli_query($link, "DELETE FROM customers WHERE cusid=$id");

//redirecting to the display page (view.php in our case)
header("Location:customerpage.php");
?>

