<?php
	session_start();
	include('conn.php');
	
	$meetid=$_GET['meetid'];
	
	$title=$_POST['title'];
	$head=$_POST['head'];
	$numattend=$_POST['numattend'];
	$listname=$_POST['listname'];
	$roomid=$_POST['roomid'];
	$start=$_POST['start'];
	$end=$_POST['end'];
	$addequipment=$_POST['addequipment'];
	$userid=$_SESSION['userid'];
	$remark=$_POST['remark'];
	// $meetfile=$_POST['meetfile'];

	// addfile
	$file=$_FILES['meetfile'];
	$filename=$_FILES["meetfile"]["name"]; 
	$filTmpename= $_FILES["meetfile"]["tmp_name"]; 
	$fileExt= explode(".",$filename);
	$fileAcExt= strtolower(end($fileExt)); 
	$newFilename= time() . "." . $fileAcExt; 
	$fileDes= 'upload/'.$newFilename;

	move_uploaded_file($filTmpename,$fileDes); 
	$meetfilelocation=$fileDes;

	mysqli_query($conn,"update meeting set title='$title', head='$head', numattend='$numattend', listname='$listname', roomid='$roomid', start='$start', end='$end', addequipment='$addequipment', userid='$userid', remark='$remark', meetfile='$meetfilelocation'  where meetid='$meetid'");
	header('location:addmeet.php');

	// echo "update meeting set title='$title', head='$head', numattend='$numattend', listname='$listname', roomid='$roomid', start='$start', end='$end', addequipment='$addequipment', userid='$userid', remark='$remark', meetfile='$meetfile'  where meetid='$meetid'";

?>