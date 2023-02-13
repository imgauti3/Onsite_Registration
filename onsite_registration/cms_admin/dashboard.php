<?php @session_start(); include_once('top_link.php'); 

 $sqry = mysqli_query($connect, "SELECT * FROM `registration` where uid<>'Pending Registartion'");
    $data['totalReg'] = mysqli_num_rows($sqry);
 $sqry = mysqli_query($connect, "SELECT * FROM `registration` where uid='Pending Registartion'");
    $data['PendingReg'] = mysqli_num_rows($sqry);
 $sqry = mysqli_query($connect, "SELECT * FROM `registration` where promocode <> '' and promocode <>'NA'");
    $data['promoReg'] = mysqli_num_rows($sqry);
 $sqry = mysqli_query($connect, "SELECT * FROM `registration` where uid<>'Pending Registartion' and reg_category_type in ('1','2','12','13','16','18','20','22','24')");
    $data['PCWOffline'] = mysqli_num_rows($sqry);
 $sqry = mysqli_query($connect, "SELECT * FROM `registration` where uid<>'Pending Registartion' and reg_category_type in ('3','4','14','15','17','19','21','23','25')");
    $data['PCWOnline'] = mysqli_num_rows($sqry);
 $sqry = mysqli_query($connect, "SELECT * FROM `registration` where uid<>'Pending Registartion' and reg_category_type in ('5','6','7','12','13','16','18','20','22','24')");
    $data['ConfOffline'] = mysqli_num_rows($sqry);
 $sqry = mysqli_query($connect, "SELECT * FROM `registration` where uid<>'Pending Registartion' and reg_category_type in ('8','9','10','11','14','15','17','19','21','23','25')");
    $data['ConfOnline'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='1'");
    $data['AcceptedAbs'] = mysqli_num_rows($sqry);
    // $totalAbs = $data['totalAbs'];
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='2'");
    $data['RejectedAbs'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='0'");
    $data['PendingAbs'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='Approve'");
    $data['ApprovedAbs'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='pending'");
    $data['PendingAbs'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='Reject'");
    $data['RejectAbs'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='Approve' and approved_for in ('Free Paper Presentation', 'Free Paper')");
    $data['ApprovedAbsFree'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='Approve' and approved_for in ('Poster Presentation','Srikiran best physical poster')");
    $data['ApprovedAbsPos'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='Approve' and approved_for in ('E-Poster Presentation', 'E-Posters')");
    $data['ApprovedAbsEpos'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='Approve' and approved_for = 'Instruction Courses'");
    $data['ApprovedAbsIC'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='Approve' and approved_for = 'Raghavachar Best Paper'");
    $data['AcceptedAbsRagha'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='Approve' and approved_for = 'Akira Prabhakar best video'");
    $data['ApprovedAbsVideo'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='Approve' and approved_for = 'Vishnuvardhan Best Anterior Segment Paper'");
    $data['ApprovedAbsVishnu'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='Approve' and approved_for = 'T. Satyanarayana Reddy Best PG Paper'");
    $data['ApprovedAbsTSBestPG'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='Approve' and approved_for = 'Vengal Rao Best paper'");
    $data['ApprovedAbsVRBestPaper'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='Approve' and approved_for = 'Nayana Sriram Best Posterior segment paper'");
    $data['ApprovedAbsNSPaper'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='1' and approved_for='Oral Presentation'");
    $data['AcceptedOral'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `abstract_submission` where status='1' and approved_for='ePoster Presentation'");
    $data['AcceptedEpos'] = mysqli_num_rows($sqry);
?>


            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">
                            <div class="pull-left">
                                <h1 class="title">Dashboard</h1>                            
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box nobox">
                            <div class="content-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <a href="approved_registration.php" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">
                                            <i class='pull-left fa fa-users icon-md icon-rounded icon-primary'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $data['totalReg'];?></strong></h4>
                                                <span style="font-size: 17px; font-weight: bold;">Registered Delegate</span>
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <a href="pending_registration.php" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">
                                            <i class='pull-left fa fa-users icon-md icon-rounded icon-orange'></i>
                                            <div class="stats">
                                                <h4> <strong><?php echo $data['PendingReg'];?></strong></h4>
                                                <span style="font-size: 17px; font-weight: bold;">Pending Registration</span>
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                         <a href="approved_abstracts.php" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">
                                            <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-primary'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $data['ApprovedAbs'];?></strong></h4>
                                                <span style="font-size: 17px; font-weight: bold;">Approved Abstract</span>
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                         <a href="pending_abstracts.php" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">
                                            <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-orange'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $data['PendingAbs'];?></strong></h4>
                                                <span style="font-size: 17px; font-weight: bold;">Pending Abstract</span>
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                         <a href="reject_abstracts.php" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">
                                            <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-warning'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $data['RejectAbs'];?></strong></h4>
                                                <span style="font-size: 17px; font-weight: bold;">Reject Abstract</span>
                                            </div>
                                        </div></a>
                                    </div>
                                    
                                    
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                         <a href="#" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">
                                            <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-primary'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $data['ApprovedAbsVideo'];?></strong></h4>
                                                <span style="font-size: 17px; font-weight: bold;">Approved Akira Best Video</span>
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                         <a href="#" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">
                                            <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-orange'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $data['ApprovedAbsIC'];?></strong></h4>
                                                <span style="font-size: 17px; font-weight: bold;">Approved Instruction Courses</span>
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                         <a href="#" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">
                                            <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-warning'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $data['ApprovedAbsNSPaper'];?></strong></h4>
                                                <span style="font-size: 17px; font-weight: bold;">Approved Nayana Sriram Best Posterior segment paper</span>
                                            </div>
                                        </div></a>
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="#" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">
                                            <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-primary'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $data['AcceptedAbsRagha'];?></strong></h4>
                                                <span style="font-size: 17px; font-weight: bold;">Approved Raghavachar Best Paper</span>
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                         <a href="#" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">
                                            <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-orange'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $data['ApprovedAbsTSBestPG'];?></strong></h4>
                                                <span style="font-size: 17px; font-weight: bold;">Approved T. Satyanarayana Reddy Best PG Paper</span>
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                         <a href="#" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">
                                            <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-warning'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $data['ApprovedAbsVRBestPaper'];?></strong></h4>
                                                <span style="font-size: 17px; font-weight: bold;">Approved Vengal Rao Best paper</span>
                                            </div>
                                        </div></a>
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                         <a href="#" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">
                                            <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-primary'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $data['ApprovedAbsVishnu'];?></strong></h4>
                                                <span style="font-size: 17px; font-weight: bold;">Approved Vishnuvardhan Best Anterior Segment Paper</span>
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                         <a href="#" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">
                                            <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-orange'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $data['ApprovedAbsPos'];?></strong></h4>
                                                <span style="font-size: 17px; font-weight: bold;">Approved Poster</span>
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                         <a href="#" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">
                                            <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-warning'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $data['ApprovedAbsEpos'];?></strong></h4>
                                                <span style="font-size: 17px; font-weight: bold;">Approved E-Poster</span>
                                            </div>
                                        </div></a>
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                         <a href="#" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">
                                            <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-primary'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $data['ApprovedAbsFree'];?></strong></h4>
                                                <span style="font-size: 17px; font-weight: bold;">Approved Free Paper</span>
                                            </div>
                                        </div></a>
                                    </div>
                                    <!--<div class="col-md-3 col-sm-6 col-xs-12">-->
                                    <!--    <a href="eposter_approved_abstracts.php" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">-->
                                    <!--        <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-warning'></i>-->
                                    <!--        <div class="stats">-->
                                    <!--            <h4><strong><?php echo $data['AcceptedEpos'];?></strong></h4>-->
                                    <!--            <span style="font-size: 17px; font-weight: bold;">ePoster Presentation</span>-->
                                    <!--        </div>-->
                                    <!--    </div></a>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-6 col-sm-6 col-xs-12">-->
                                    <!--     <a href="reviewed_abstracts.php" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">-->
                                    <!--        <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-orange'></i>-->
                                    <!--        <div class="stats">-->
                                    <!--            <h4><strong><?php echo $data['ReviewedAbs'];?></strong></h4>-->
                                    <!--            <span style="font-size: 17px; font-weight: bold;">Reviewed Abstract</span>-->
                                    <!--        </div>-->
                                    <!--    </div></a>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-6 col-sm-6 col-xs-12">-->
                                    <!--     <a href="pending_reviewed_abstracts.php" style="text-decoration:none;color:#000;"><div class="r4_counter db_box">-->
                                    <!--        <i class='pull-left fa fa-file-text-o icon-md icon-rounded icon-orange'></i>-->
                                    <!--        <div class="stats">-->
                                    <!--            <h4><strong><?php echo $data['ReviewedAbs'];?></strong></h4>-->
                                    <!--            <span style="font-size: 17px; font-weight: bold;">Pending Review</span>-->
                                    <!--        </div>-->
                                    <!--    </div></a>-->
                                    <!--</div>-->
                                </div> <!-- End .row -->
                                
                                <!--<div class="row">
                                    <div class="col-md-12 col-sm-7 col-xs-12">
                                        <div class="r1_maingraph db_box">
                                            <span class='pull-left'>
                                                <i class='icon-purple fa fa-square icon-xs'></i>&nbsp;<small>PAGE VIEWS</small>&nbsp; &nbsp;<i class='fa fa-square icon-xs icon-primary'></i>&nbsp;<small>UNIQUE VISITORS</small>
                                            </span>
                                            <div id="db_morris_bar_graph" style="height:272px;width:100%;"></div>
                                        </div>
                                    </div>
                                </div>  End .row -->
                            </div>
                        </section>
                    </div>
                </section>
            </section>

<?php include_once('bottom_link.php'); ?>
<!--<script>-->
<!--    function ajaxCall() {-->
<!--    $.ajax({-->
<!--        type:"post",-->
<!--        url:"process.php",-->
<!--        data:"getData=1",-->
<!--        datatype:'json',-->
<!--        success:function(data){-->
<!--            var parsed=$.parseJSON(data);-->
<!--            $("#totalAbstract").html(parsed.totalAbs);-->
<!--            $("#AcceptedAbstract").html(parsed.AcceptedAbs);-->
<!--            $("#RejectedAbstract").html(parsed.RejectedAbs);-->
<!--            $("#PendingAbstract").html(parsed.PendingAbs);-->
<!--        }-->
<!--    });-->
<!--}-->
<!--</script>-->