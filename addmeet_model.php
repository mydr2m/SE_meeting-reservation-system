<?php
	session_start();
	include('conn.php');
	
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

	mysqli_query($conn, "insert into meeting (title, head, numattend, listname, roomid, start, end, addequipment, userid, remark, meetfile) 
	values ('$title', '$head', '$numattend', '$listname', '$roomid', '$start', '$end', '$addequipment', '$userid', '$remark', '$meetfilelocation')");
	header('location:addmeet.php');

	// if(mysqli_query($conn, "insert into meeting (title, head, numattend, listname, roomid, start, end, addequipment, userid, remark, meetfile) 
	// values ('$title', '$head', '$numattend', '$listname', '$roomid', '$start', '$end', '$addequipment', '$userid', '$remark', '$meetfile')"))
	// {
	// 	header('location:addmeet.php');
	// }
	// else{
	// 	echo "ERROr <br>";
	// 	echo $title."<br>". $head."<br>". $numattend."<br>". $listname."<br>". $roomid."<br>". $start."<br>". $end."<br>". $addequipment."<br>". $remark."<br>". $meetfile."<br>". $userid;
	// }

	// echo "insert into test (title, head, numattend, listname, roomid, start, end, addequipment, userid, remark, meetfile) 
	// values ('$title', '$head', '$numattend', '$listname', '$roomid', '$start', '$end', '$addequipment', '$userid', '$remark', '$meetfile')";
?>