<?php 
	require 'education.php';
	$edu = new education;
	$edu->setId($_REQUEST['shipid']);
	$edu->setLat($_REQUEST['lat']);
	$edu->setLng($_REQUEST['lng']);
	$status = $edu->updateCollegesWithLatLng();
	if($status == true) {
		echo "Updated...";
	} else {
		echo "Failed...";
	}
 ?>