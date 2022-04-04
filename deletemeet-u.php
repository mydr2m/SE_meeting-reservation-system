<?php
	include('conn.php');
	$id=$_GET['id'];
	mysqli_query($conn,"delete from events where id='$id'");
	header('location:addmeet-u.php');

?>