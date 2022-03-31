<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>ระบบจองห้องประชุม</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;700&family=Prompt:wght@400;700&display=swap');

		body {
			background-image: url('http://wesmilemagazine.com/wp-content/uploads/2019/05/Khonkaen1.jpg');
			background-repeat: no-repeat;
			background-size: 100%;
			width: 100%;
			height: 100vh;
			box-sizing: border-box;
			font-family: 'Prompt';
		}

		.box {
			display: flex;
			align-items: center;
			height: 100vh;
			width: 100%;
			margin: auto;
			background-color: #ebebeb52;
			padding: 10%;
		}

		.box-1 {
			display: flex;
			align-items: center;
			width: 60%;
		}

		.box-1 .textbox h1,
		h3 {
			text-shadow: 1px 1px 2px rgba(255, 255, 255, 1);
		}

		.box-2 {
			width: 35%;
			text-align: center;
			background-color: #ffe595;
			padding: 30px 60px;
			border-radius: 12px;
			box-shadow: 2px 2px 8px 4px rgba(0, 0, 0, 0.1);
		}

		.box-2 form input {
			width: 100%;
			margin-bottom: 0.5rem;
		}

		.box-2 .button {
			display: flex;
		}

		button {
			width: 49%;
		}

		button:nth-child(1) {
			margin-right: 2%;
		}
	</style>
</head>

<body>
	<div class="box">
		<div class="box-1">
			<div class="imgbox mr-4">
				<img src="./img/logo.png">
			</div>
			<div class="textbox">
				<h1>จองห้องประชุม</h1>
				<h3>เทศบาลนครขอนแก่น</h3>
				<!-- <a href="login.php" class="btn btn-warning" role="button">เข้าสู่ระบบ</a> -->
			</div>
		</div>
		<div class="box-2">
			<h3>เข้าสู่ระบบ</h3>
			<form role="form" method="post" action="login.php">
				<input type="text" name="username" class="form-control input_user" value="" placeholder="Username">
				<input type="password" name="password" class="form-control input_pass" value="" placeholder="Password">
				<div class="button">
					<button type="submit" name="login" class="btn btn-warning">เข้าสู่ระบบ</button>
					<button type="reset" name="reset" class="btn btn-default">รีเซ็ต</button>
				</div>
			</form>
		</div>
	</div>


</body>

</html>

<?php

include("conn.php");

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$check_user = "select * from user WHERE username='$username' AND password='$password'";

	$result = $conn->query($check_user);

	$row = mysqli_fetch_array($result);


	if ($result->num_rows > 0) {
		if ($row['type'] == "01") {
			$_SESSION['user'] = $username;
			$_SESSION['userid'] = $row['user_id'];
			echo "<script>window.open('calendar.php','_self')</script>";
		} else {
			$_SESSION['user'] = $username;
			$_SESSION['userid'] = $row['user_id'];
			echo "<script>window.open('userpage.php','_self')</script>";
		}
	} else {
		echo "<script>alert('username or password is incorrect!')</script>";
		echo "<script>window.open('login.php','_self')</script>";
	}
}
?>