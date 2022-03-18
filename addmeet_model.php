<?php
session_start();
include('conn.php');

$title = $_POST['title'];
$head = $_POST['head'];
$numattend = $_POST['numattend'];
$listname = $_POST['listname'];
$roomid = $_POST['roomid'];
$start = $_POST['start'];
$end = $_POST['end'];
$addequipment = $_POST['addequipment'];
$userid = $_SESSION['userid'];
$remark = $_POST['remark'];
$meetfile = $_FILES['meetfile'];

// echo $meetfile;
// $target_dir = "upload/";
// $target_file = $target_dir . basename($_FILES["meetfile"]["name"]);
// $uploadOK = 1;
// $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// if (file_exists($target_file)) {
// 	echo "Sorry, file already exists.";
// 	$uploadOk = 0;
// }

// if ($uploadOk == 0) {
// 	echo "<script>console.log('Sorry, your file was not uploaded.')</script>";
// } else {
// 	if (move_uploaded_file($_FILES["meetfile"]["tmp_name"], $target_file)) {
// 		echo "<script>console.log('OK.')</script>";
// 	} else {
// 		echo "<script>console.log('Sorry')</script>";
// 	}
// }


// addfile
$file = $_FILES['meetfile'];
$filename = $_FILES['meetfile']['name'];
$fileTempname = $_FILES['meetfile']['tmp_name'];
$fileExt = explode(".",$filename);
$fileAcExt = strtolower(end($fileExt));
$newFilename = time() . "." . $fileAcExt;
$fileDes = 'upload/' . $newFilename;

move_uploaded_file($fileTempname,$fileDes);
$meetfilelocation = $fileDes;

mysqli_query($conn, "insert into meeting (title, head, numattend, listname, roomid, start, end, addequipment, userid, remark, meetfile) 
	values ('$title', '$head', '$numattend', '$listname', '$roomid', '$start', '$end', '$addequipment', '$userid', '$remark', '$meetfilelocation')");
header('location:addmeet.php');

	// echo "insert into test (title, head, numattend, listname, roomid, start, end, addequipment, userid, remark, meetfile) 
	// values ('$title', '$head', '$numattend', '$listname', '$roomid', '$start', '$end', '$addequipment', '$userid', '$remark', '$meetfile')";
