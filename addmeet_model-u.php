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

$file = $_FILES['meetfile'];
$filename = $_FILES['meetfile']['name'];
$fileTempname = $_FILES['meetfile']['tmp_name'];
$fileExt = explode(".", $filename);
$fileAcExt = strtolower(end($fileExt));
$newFilename = time() . "." . $fileAcExt;
$fileDes = 'upload/' . $newFilename;

move_uploaded_file($fileTempname, $fileDes);
$meetfilelocation = $fileDes;

mysqli_query($conn, "insert into events (title, head, numattend, listname, roomid, start, end, addequipment, userid, remark, meetfile, color) 
 values ('$title', '$head', '$numattend', '$listname', '$roomid', '$start', '$end', '$addequipment', '$userid', '$remark', '$meetfilelocation', '')");
header('location:addmeet-u.php');

// echo "insert into events (title, head, numattend, listname, roomid, start, end, addequipment, userid, remark, meetfile, color) 
// values ('$title', '$head', '$numattend', '$listname', '$roomid', '$start', '$end', '$addequipment', '$userid', '$remark', '$meetfilelocation', '')";

?>