<?php
@session_start();
include_once("db.php");
$username = '';
if(isset($_GET['uniquId'])){

	$uniquId = $_GET['uniquId'];
	$check=mysqli_query($connect,"select * from delegate_list where unique_id = $uniquId ");
	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>VDO | Onsite Registration Software</title>

	<!-- Favicons -->
	<link type="image/x-icon" href="assets/img/favicon.png" rel="icon">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">


	<style>
		.select-method-wrap .select-method {
			width: 90px;
			height: 90px;
			padding: 10px;
			border-radius: 50%;
			margin: 20px auto;
			background-color: #FFFFFF;
			color: #000000 !important;
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
		}

		.select-method-wrap input:checked~.select-method {
			background-color: #FF9F36;
			color: #FFFFFF;
		}
	</style>
</head>
<body>
	<!-- Main Wrapper -->
	<div class="main-wrapper">
		<style>
			@page {
				size: auto;
				margin: 0mm;
			}

			@media print {

				html,
				body {
					width: auto;
					height: 99%;

				}

				.main-wrapper {
					display: none;
				}

				#printSection,
				#printSection * {
					visibility: visible;
				}

				#printSection {
					position: absolute;
					left: 0;
					top: 0;
				}
			}
		</style>
		<div class="appmt-form doctors-col" style="background-image: url('bg.jpg');background-repeat: no-repeat;background-size: 100% 100%;padding:200px 0px 400px;">
			<div class="container">
				<div class="row justify-content-center">
					<div class="doctors-title text-center" style="margin-top:-90px;">
						<img src="head2.png" style="width:500px;">
					</div>
				</div>
				<div class="row justify-content-center">
					<h1 style="font-weight:bold;font-size:70px;color:white">Welcome</h1>
				</div>
				
				<div class="row justify-content-center">
					<h1 style="font-weight:bold;font-size:45px;color:white">John Deo</h1>
				</div>
				
				<div class="row justify-content-center">
					<h1 style="font-weight:bold;font-size:45px;color:white">Thank you for Registration</h1>
				</div>
			</div>
		</div>
	</div>
</body>
</html>