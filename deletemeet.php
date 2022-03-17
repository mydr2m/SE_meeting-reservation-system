<?php
	include('conn.php');
	$meetid=$_GET['meetid'];
	mysqli_query($conn,"delete from meeting where meetid='$meetid'");
	header('location:addmeet.php');

?>