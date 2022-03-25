<!DOCTYPE html>
<html>

<head>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>ระบบจองห้องประชุม</title>

	<!-- FullCalendar -->
<link href='css/fullcalendar.css' rel='stylesheet' />

<!-- Custom CSS -->
<style>
	/* body {
        padding-top: 70px;
        Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes.
    } */
	#calendar {
		max-width: 800px;
	}

	.col-centered {
		float: none;
		margin: 0 auto;
	}
</style>
</head>
<body>
	<?php include("adminmenu.php"); ?>

	<div>
		<img src="img/meeting.png" class="center-block img-fluid" alt="Responsive image">
	</div>

	<?php
	require_once('bdd.php');


	if (isset($_POST['searchhead']) && isset($_POST['searchroom'])) {
		$searchhead = $_POST['searchhead'];
		$searchroom = $_POST['searchroom'];
		$sql = "SELECT * FROM events where head = '$searchhead' && roomid = '$searchroom'";
	} else if (isset($_POST['searchhead']) && empty($_POST['searchroom'])) {
		$searchhead = $_POST['searchhead'];
		$sql = "SELECT * FROM events where head = '$searchhead';";
	} else if (isset($_POST['searchroom']) && empty($_POST['searchhead'])) {
		$searchroom = $_POST['searchroom'];
		$sql = "SELECT * FROM events where roomid = '$searchroom';";
	} else {
		$sql = "SELECT * FROM events";
	}

	$req = $bdd->prepare($sql);
	$req->execute();

	$events = $req->fetchAll();


	?>

	<center>
		<form method="POST" action="calendar.php">
			<table style="width:70%">
				<tr>
					<th>
						<span style="font-size:20px; color:black;">
							<center><strong>เลือกผู้บริหาร </strong></center>
						</span>
						<select name="searchhead" class="form-control" id="searchhead">
							<option value=""> ประธานทั้งหมด</option>
							<option value="นายกเทศมนตรี"> นายกเทศมนตรี</option>
							<option value="รองนายกเทศมนตรี1"> รองนายกเทศมนตรี1</option>
							<option value="รองนายกเทศมนตรี2"> รองนายกเทศมนตรี2</option>
							<option value="รองนายกเทศมนตรี3"> รองนายกเทศมนตรี3</option>
						</select>
					</th>
					<th>
						<span style="font-size:20px; color:black;">
							<center><strong>เลือกห้อง </strong></center>
						</span>
						<select name="searchroom" class="form-control" id="searchroom">
							<option value=" "> ห้องทั้งหมด</option>
							<?PHP
							$sql1 = "SELECT * FROM room";
							$req = $bdd->prepare($sql1);
							$req->execute();
							$room = $req->fetchAll();

							foreach ($room as $row => $room) {
								echo  '<option value=' . $room['roomid'] . '>' . $room['roomname'] . '</option>';
							}
							?>
						</select>
					</th>
					<th>
						<span style="font-size:20px; color:white;">
							<center><strong>คลิ๊ก</strong></center>
						</span>
						<button type="submit" class="btn btn-primary">ค้นหา</button>
					</th>
				</tr>
			</table>
		</form>
	</center>



	<!-- Page Content -->
	<div class="container">

		<div class="row">
			<div class="col-lg-12 text-center">
				<h1>ตารางการใช้งานห้องประชุม</h1>
				<p class="lead">
					<?php
					if (isset($_POST['searchhead']) || isset($_POST['searchroom']))
						echo "ประธาน " . $_POST['searchhead'] . "  ห้องประชุม  " . $_POST['searchroom'];
					?>

				</p>
				<div id="calendar" class="col-centered">
				</div>
			</div>

		</div>


		<!-- /.container -->

		<!-- jQuery Version 1.11.1 -->
		<script src="js/jquery.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>

		<!-- FullCalendar -->
		<script src='js/moment.min.js'></script>
		<script src='js/fullcalendar.min.js'></script>

		<script>
			$(document).ready(function() {

				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},

					defaultDate: $('#calendar').fullCalendar('today'),
					editable: false,
					eventLimit: true, // allow "more" link when too many events
					selectable: true,
					selectHelper: true,
					select: function(start, end) {

						$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd').modal('show');
					},
					eventRender: function(event, element) {
						element.bind('dblclick', function() {
							$('#ModalEdit #id').val(event.id);
							$('#ModalEdit #title').val(event.title);
							$('#ModalEdit #color').val(event.color);
							$('#ModalEdit #start').val(event.start);
							$('#ModalEdit #end').val(event.end);
							$('#ModalEdit').modal('show');
						});
					},
					eventDrop: function(event, delta, revertFunc) { // si changement de position

						edit(event);

					},
					eventResize: function(event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur

						edit(event);

					},
					events: [
						<?php foreach ($events as $event) :

							$start = explode(" ", $event['start']);
							$end = explode(" ", $event['end']);

							if ($start[1] == '00:00:00') {
								$start = $start[0];
							} else {
								$start = $event['start'];
							}
							if ($end[1] == '00:00:00') {
								$end = $end[0];
							} else {
								$end = $event['end'];
							}
						?> {
								id: '<?php echo $event['id']; ?>',
								title: '<?php echo $event['title']; ?>',
								start: '<?php echo $start; ?>',
								end: '<?php echo $end; ?>',
								color: '<?php echo $event['color']; ?>',

							},
						<?php endforeach; ?>
					]
				});

				function edit(event) {
					start = event.start.format('YYYY-MM-DD HH:mm:ss');
					if (event.end) {
						end = event.end.format('YYYY-MM-DD HH:mm:ss');
					} else {
						end = start;
					}

					id = event.id;


					Event = [];
					Event[0] = id;
					Event[1] = start;
					Event[2] = end;

					$.ajax({
						url: '',
						type: "POST",
						data: {
							Event: Event
						},
						success: function(rep) {
							if (rep == 'OK') {
								alert('test Saved');
							} else {
								alert('Could not be saved. try again.');
							}
						}
					});
				}

			});
		</script>

</body>

</html>