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
	<?php include("usermenu.php"); ?>

	<?php
	require_once('bdd.php');

	if (isset($_POST['searchhead']) && isset($_POST['searchroom'])) {
		$searchhead = $_POST['searchhead'];
		$searchroom = $_POST['searchroom'];
		$sql = "SELECT * FROM events where head = '$searchhead' && roomid = '$searchroom'";
	} else if (isset($_POST['searchhead']) && empty($_POST['searchroom'])) {
		$searchhead = $_POST['searchhead'];
		$sql = "SELECT * FROM events where head = '$searchhead' ";
	} else if (isset($_POST['searchroom']) && empty($_POST['searchhead'])) {
		$searchroom = $_POST['searchroom'];
		$sql = "SELECT * FROM events where roomid = '$searchroom'";
	} else if ($_POST['searchroom'] == "" and $_POST['searchhead'] == "") {
		$sql = "SELECT * FROM events";
	} else {
		$sql = "SELECT * FROM events";
	}

	$req = $bdd->prepare($sql);
	$req->execute();

	$events = $req->fetchAll();

	?>

	<!-- Page Content -->
	<div class="container mt-3">
		<h1 class="text-center" style="font-weight: bolder;">ปฎิทินการประชุม</h1>
			<form method="POST" action="calendar-u.php">
				<div class="searchbox d-flex mt-3" style="width: 72%; display:block; margin:auto">
				<select name="searchhead" class="form-control mr-3" id="searchhead">
					<option value=""> ประธานทั้งหมด</option>
					<option value="นายกเทศมนตรี"> นายกเทศมนตรี</option>
					<option value="รองนายกเทศมนตรี1"> รองนายกเทศมนตรี1</option>
					<option value="รองนายกเทศมนตรี2"> รองนายกเทศมนตรี2</option>
					<option value="รองนายกเทศมนตรี3"> รองนายกเทศมนตรี3</option>
				</select>
				<select name="searchroom" class="form-control mr-3" id="searchroom">
					<option value=""> ห้องทั้งหมด</option>
					<?PHP
					$sql2 = "SELECT * FROM room";
					$req = $bdd->prepare($sql2);
					$req->execute();
					$room = $req->fetchAll();

					foreach ($room as $row => $room) {
						echo  '<option value=' . $room['roomid'] . '>' . $room['roomname'] . '</option>';
					}
					?>
				</select>
				<button type="submit" class="btn btn-primary">ค้นหา</button>
			</div>
		</form>
		

		<div class="calendarbox mt-10">
			<p class="lead mt-3 mb-3" style="text-align: center;">
				<?php
				if (isset($_POST['searchhead']) || isset($_POST['searchroom']))
					echo "ประธาน " . $_POST['searchhead'] . "  ห้องประชุม  " . $_POST['searchroom'];
				?>
			</p>
			<div id="calendar" class="col-centered mb-5"></div>
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