<?php
@session_start();
include_once("session_validate.php");
include_once('../config.php');
$pageUrl = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html class=" ">
    <head>
        <!-- 
         * @Package: Ultra Admin - Responsive Theme
         * @Subpackage: Bootstrap
         * @Version: 4.1
         * This file is part of Ultra Admin Theme.
        -->
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title><?php echo $event_name;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />    <!-- Favicon -->
        <link rel="apple-touch-icon-precomposed" href="assets/images/apple-touch-icon-57-precomposed.png">	<!-- For iPhone -->
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/apple-touch-icon-114-precomposed.png">    <!-- For iPhone 4 Retina display -->
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/apple-touch-icon-72-precomposed.png">    <!-- For iPad -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/apple-touch-icon-144-precomposed.png">    <!-- For iPad Retina display -->




        <!-- CORE CSS FRAMEWORK - START -->
        <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS FRAMEWORK - END -->

        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->  
		<link href="assets/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="assets/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="assets/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css" media="screen"/> 
        <link href="assets/plugins/jquery-ui/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="assets/plugins/datepicker/css/datepicker.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="assets/plugins/daterangepicker/css/daterangepicker-bs3.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="assets/plugins/timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="assets/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="assets/plugins/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="assets/plugins/ios-switch/css/switch.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="assets/plugins/tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="assets/plugins/typeahead/css/typeahead.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="assets/plugins/multi-select/css/multi-select.css" rel="stylesheet" type="text/css" media="screen"/> 
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE CSS TEMPLATE - START -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS TEMPLATE - END -->
        
        <style>
        .page-topbar .logo-area {
            background-image: url('<?php echo $website_logo;?>') !important;
            background-repeat: no-repeat;
        }   
        </style>

    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" ">
        <!-- START TOPBAR -->
        <div class='page-topbar '>
            <div class='logo-area'>

            </div>
            <div class='quick-area'>
                <div class='pull-left'>
                    <ul class="info-menu left-links list-inline list-unstyled">
                        <li class="sidebar-toggle-wrap">
                            <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
					   <li class="hidden-sm hidden-xs searchform">
                            <p><?php echo $event_name;?></p>
                        </li>
                    </ul>
                </div>		
                <div class='pull-right'>
                    <ul class="info-menu right-links list-inline list-unstyled">
                        <li class="profile">
                            <a href="#" data-toggle="dropdown" class="toggle">
                                <img src="<?php echo $admin_profile_logo;?>" alt="user-image" class="img-circle img-inline">
                                <span><?php echo $event_name;?><i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu profile animated fadeIn">
                                <li>
                                    <a href="#settings">
                                        <i class="fa fa-wrench"></i>
                                        Settings
                                    </a>
                                </li>
                                <li class="last">
                                    <a href="logout.php">
                                        <i class="fa fa-lock"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>			
                </div>		
            </div>

        </div>
        <!-- END TOPBAR -->
        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <!-- SIDEBAR - START -->
            <div class="page-sidebar ">

                <!-- MAIN MENU - START -->
                <div class="page-sidebar-wrapper" id="main-menu-wrapper"> 

                    <!-- USER INFO - START -->
                    <div class="profile-info row">

                        <div class="profile-image col-md-4 col-sm-4 col-xs-4">
                            <a href="#">
                                <img src="<?php echo $admin_profile_logo;?>" class="img-responsive img-circle">
                            </a>
                        </div>

                        <div class="profile-details col-md-8 col-sm-8 col-xs-8">

                            <h3> 
                                <a href="#"><?php echo $event_name;?></a>
                                <span class="profile-status online"></span>
                            </h3>
                            <!--<p class="profile-title">Ongole</p>-->

                        </div>

                    </div>
                    <!-- USER INFO - END -->



                    <ul class='wraplist'>
                        <li <?php if ($pageUrl == 'dashboard.php') { ?> class="open" <?php } ?>> 
                            <a <?php if ($pageUrl == 'dashboard.php') { ?> class="active" <?php } ?> href="dashboard.php">
                                <i class="fa fa-dashboard"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="<?php if ($pageUrl == 'new_registration.php' || $pageUrl == 'pending_registration.php' || $pageUrl == 'approved_registration') echo 'open';?>">
                            <a href="javascript:;">
                                <i class="fa fa-sliders"></i>
                                <span class="title">Registration</span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu" <?php if ($pageUrl == 'new_registration.php' || $pageUrl == 'pending_registration.php' || $pageUrl == 'approved_registration') { ?> style='display:block;' <?php } else { ?> style='display:none;' <?php } ?>>
                                <li>
                                    <a <?php if ($pageUrl == 'new_registration.php') { ?> class="active" <?php } ?> href="new_registration.php" >Add New Registration</a>
                                </li>
                                <li>
                                    <a <?php if ($pageUrl == 'pending_registration.php') { ?> class="active" <?php } ?> href="pending_registration.php" >Pending Registration</a>
                                </li>
                                <li>
                                    <a <?php if ($pageUrl == 'approved_registration.php') { ?> class="active" <?php } ?> href="approved_registration.php" >Approved Registration</a>
                                </li>
                            </ul>
                        </li>
                        
                        
                        
       <!--                 <li class="<?php if ($pageUrl == 'approved_poster.php' || $pageUrl == 'approved_poster.php') echo 'open';?>">-->
       <!--                 	<a href="javascript:;">-->
       <!--                 		<i class="fa fa-sliders"></i>-->
       <!--                 		<span class="title">Approved Poster</span>-->
       <!--                 		<span class="arrow open"></span>-->
       <!--                 	</a>-->
       <!--                 	<ul class="sub-menu">-->
       <!--                 		<li><a href="approved_poster.php?abs_category=Cardiology" >Cardiology</a></li>-->
       <!--                 		<li><a href="approved_poster.php?abs_category=Neurology" >Neurology</a></li>-->
       <!--                 		<li><a href="approved_poster.php?abs_category=Nephrology" >Nephrology</a></li>-->
       <!--                 		<li><a href="approved_poster.php?abs_category=Endocrinology" >Endocrinology</a></li>-->
       <!--                 		<li><a href="approved_poster.php?abs_category=Geriatrics" >Geriatrics</a></li>-->
       <!--                 		<li><a href="approved_poster.php?abs_category=Gastroenterology" >Gastroenterology</a></li>-->
       <!--                 		<li><a href="approved_poster.php?abs_category=Haematology" >Haematology</a></li>-->
       <!--                 		<li><a href="approved_poster.php?abs_category=Rheumatology" >Rheumatology</a></li>-->
       <!--                 		<li><a href="approved_poster.php?abs_category=Respiratory%20Diseases" >Respiratory Diseases</a></li>-->
       <!--                 		<li><a href="approved_poster.php?abs_category=Poisoning%20and%20Toxicology" >Poisoning and Toxicology</a></li>-->
       <!--                 		<li><a href="approved_poster.php?abs_category=Infectious%20Diseases" >Infectious Diseases</a></li>-->
       <!--                 		<li><a href="approved_poster.php?abs_category=Oncology" >Oncology</a></li>-->
       <!--                 		<li><a href="approved_poster.php?abs_category=Critical%20Care" >Critical Care</a></li>-->
       <!--                 		<li><a href="approved_poster.php?abs_category=Miscellaneous" >Miscellaneous</a></li>-->
       <!--                 	</ul>-->
       <!--                 </li>-->
       <!--                 <li class="<?php if ($pageUrl == 'approved_platform.php' || $pageUrl == 'approved_platform.php') echo 'open';?>">-->
       <!--                 	<a href="javascript:;">-->
       <!--                 		<i class="fa fa-sliders"></i>-->
       <!--                 		<span class="title">Approved Platform</span>-->
       <!--                 		<span class="arrow open"></span>-->
       <!--                 	</a>-->
       <!--                 	<ul class="sub-menu">-->
       <!--                 		<li><a href="approved_platform.php?abs_category=Cardiology" >Cardiology</a></li>-->
       <!--                 		<li><a href="approved_platform.php?abs_category=Neurology" >Neurology</a></li>-->
       <!--                 		<li><a href="approved_platform.php?abs_category=Nephrology" >Nephrology</a></li>-->
       <!--                 		<li><a href="approved_platform.php?abs_category=Endocrinology" >Endocrinology</a></li>-->
       <!--                 		<li><a href="approved_platform.php?abs_category=Geriatrics" >Geriatrics</a></li>-->
       <!--                 		<li><a href="approved_platform.php?abs_category=Gastroenterology" >Gastroenterology</a></li>-->
       <!--                 		<li><a href="approved_platform.php?abs_category=Haematology" >Haematology</a></li>-->
       <!--                 		<li><a href="approved_platform.php?abs_category=Rheumatology" >Rheumatology</a></li>-->
       <!--                 		<li><a href="approved_platform.php?abs_category=Respiratory%20Diseases" >Respiratory Diseases</a></li>-->
       <!--                 		<li><a href="approved_platform.php?abs_category=Poisoning%20and%20Toxicology" >Poisoning and Toxicology</a></li>-->
       <!--                 		<li><a href="approved_platform.php?abs_category=Infectious%20Diseases" >Infectious Diseases</a></li>-->
       <!--                 		<li><a href="approved_platform.php?abs_category=Oncology" >Oncology</a></li>-->
       <!--                 		<li><a href="approved_platform.php?abs_category=Critical%20Care" >Critical Care</a></li>-->
       <!--                 		<li><a href="approved_platform.php?abs_category=Miscellaneous" >Miscellaneous</a></li>-->
       <!--                 	</ul>-->
       <!--                 </li>-->
       <!--                 <li class=""> -->
							<!--<a href="#"> <i class="fa fa-gears"></i><span class="title">Settings</span></a>-->
       <!--                 </li>-->
                        <li class=""> 
							<a href="logout.php"> <i class="fa fa-sign-out"></i><span class="title">Logout</span></a>
                        </li>
                    </ul>

                </div>
                <!-- MAIN MENU - END -->

            </div>
            <!--  SIDEBAR - END -->