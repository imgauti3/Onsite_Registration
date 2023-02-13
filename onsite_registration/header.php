<?php
@session_start();
include_once("db.php");
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
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			<header class="header home">
				<div class="top-header">
					<div class="container-fluid">
						<div class="row justify-content-between align-items-center">
							<div class="col-12 col-md-6">
								<div class="left">
									<ul>
										<li><span><i class="fas fa-phone-alt"></i> Contact Number : 8121118508</span></li>
										<li><span><i class="fas fa-map-marker-alt"></i> Location : Hyderabad, Telangana</span></li>
									</ul>									
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="right">
									<ul>
										<li><span><i class="fas fa-calendar-check"></i> Mon - Fri : 09.00 AM to 05.00 PM</span></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<!-- /Header -->		  
			
			<!-- Counts -->
			<section class="count-section">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-12 col-lg-12">
							<div class="row">
								<div class="col-12 col-md-3">
									<div class="count-box text-center">
										<h3 id="totalRegistartions"></h3>
										<p class="mb-0">Total Registration</p>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="count-box text-center">
										<h3 id="badgesPrinted"></h3>
										<p class="mb-0">No of Badges Printed</p>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="count-box text-center">
										<h3 id="kitbagDelivered"></h3>
										<p class="mb-0">No of Kitbags Delivered</p>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="count-box text-center">
										<h3 id="certificateIssued"></h3>
										<!--<h3 id="certificateDelivered"></h3>-->
										<p class="mb-0">No of Certificate Issue</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>				
			</section>
			<!-- /Counts -->