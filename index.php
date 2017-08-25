<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="height=device-height, initial-scale=1">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="jquery-3.1.0.min.js"></script>
		<?php
			include_once 'chris_test.php';
			$init = new feedclass();
			$data = $init->init();
		?>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<h1>Creative Tech Service Desk</h1>
			</div>

			<div class="mainWrapper">
				<div class="box box1">
					<div class="boxName">
						<p>New Tickets</p>
					</div>
					<div class="boxNum">
						<span class="numbers"><?php echo $data['open'] ?></span>
					</div>
				</div>

				<div class="box box2">
					<div class="boxName">
						<p>Working On</p>
					</div>
					<div class="boxNum">
						<span class="numbers"><?php echo $data['workingOnIt'] ?></span>
					</div>
				</div>

				<div class="box box3">
					<div class="boxName">
						<p>Waiting On...</p>
					</div>
					<div class="boxNum">
						<span class="numbers"><?php echo $data['waitingOn...'] ?></span>
					</div>
				</div>

				<div class="box box4">
					<div class="boxName">
						<p>Ad Builder</p>
					</div>
					<div class="boxNum">
						<span class="numbers"><?php echo $data['waitingOnAdBuilder'] ?></span>
					</div>
				</div>

				<div class="box box5">
					<div class="boxName">
						<p>Creative Manager</p>
					</div>
					<div class="boxNum">
						<span class="numbers"><?php echo $data['waitingOnCreativeManager'] ?></span>
					</div>
				</div>

				<div class="box box6">
					<div class="boxName">
						<p>JS Dev</p>
					</div>
					<div class="boxNum">
						<span class="numbers"><?php echo $data['waitingOnjsDev'] ?></span>
					</div>
				</div>
			</div>


		</div>

		<script>

			setTimeout(function(){ location.reload(); }, 300000);

		</script>

	</body>

</html>