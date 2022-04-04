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
		h1 {
			font-weight: bolder;
			text-align: center;
			margin-bottom: 10px;
		}

		thead {
			text-align: center;
			
		}
		td:nth-child(12) {
			display: block;
		}

		td:nth-child(12) a{
			width: 100%;
		}
		td:nth-child(12) a:nth-child(1){
			margin-bottom: 5px;
		}
	</style>

</head>

<body>
	<?php include("usermenu.php"); ?>

	<div class="container mt-3">
		<div class="well" style="margin:auto; padding:auto; width:100%;">
			<h1>การประชุม</h1>
			<a href="#addnew" data-toggle="modal" class="btn btn-primary mb-3">เพิ่มการประชุม</a>
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<th style="width: 3%;">รหัสการจอง</th>
					<th>วาระประชุม</th>
					<th>ประธานการประชุม</th>
					<th style="width: 5%;">จำนวนผู้เข้าประชุม</th>
					<th>ผู้เข้าร่วมประชุม</th>
					<th style="width: 5%;">ห้องประชุม</th>
					<th>วันเวลาเริ่มประชุม</th>
					<th>วันเวลาสิ้นสุดการประชุม</th>
					<th>อุปกรณ์เพิ่มเติม</th>
					<th>หมายเหตุ</th>
					<th>เอกสาร</th>
					<th>จัดการ</th>
				</thead>
				<tbody>
					<?php
					include('conn.php');

					$query = mysqli_query($conn, "select * from events");
					while ($row = mysqli_fetch_array($query)) {
					?>
						<tr>
							<td class="text-center"><?php echo $row['id']; ?></td>
							<td><?php echo $row['title']; ?></td>
							<td><?php echo $row['head']; ?></td>
							<td><?php echo $row['numattend']; ?></td>
							<td><?php echo $row['listname']; ?></td>
							<td><?php echo $row['roomid']; ?></td>
							<td><?php echo $row['start']; ?></td>
							<td><?php echo $row['end']; ?></td>
							<td><?php echo $row['addequipment']; ?></td>
							<td><?php echo $row['remark']; ?></td>
							<td><a href="<?php echo $row['meetfile']; ?>">ดูไฟล์</a></td>
							<td>
								<a href="#edit<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>แก้ไข</a>
								<a href="#del<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>ยกเลิก</a>
								<?php include('meetaction-u.php'); ?>
							</td>
						</tr>
					<?php
					}

					?>
				</tbody>
			</table>
		</div>
		<?php include('addmeet_view-u.php'); ?>
	</div>







	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>