<?php
ob_start();
//error_reporting(0);
require_once("dompdf/dompdf_config.inc.php");
include_once"../../dbconfig.php";
$regID=base64_decode($_REQUEST['regID']);
$rmb_basic=" status='Active'";
$rmbbasicdetls=$Financial->Generate_records($rmb_basic,'basic_settings');

$rmb_insuranceqry=" id='$regID'";
$rmbinsurance_dtl=$Financial->Generate_records($rmb_insuranceqry,'rmb_insurance_dtl');

$rmb_agreement=$rmbinsurance_dtl[0]['rmb_agreement'];
if($rmb_agreement=="")
{	
$rmb_inc_category=" id='".$rmbinsurance_dtl[0]['rmb_category_id']."'";
$rmbinsurance_catg=$Financial->Generate_records($rmb_inc_category,'rmb_category');

//insert into download table
$downloaddate=date('Y-m-d H:i:s');
$sqldownload=mysqli_query($connection,"insert into rmb_insurance_doc_download(rmb_insurance_dtl_id,rmb_doc_download_date,status,created_on,created_by)values
('$regID','$downloaddate','Active','$downloaddate','1')");

?>
<!--
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Print Ticket</title>-->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
<!-- <link rel="stylesheet" href="css/style.css"></link> -->
<style type="text/css">
body {
	width:100%;
	/* max-width:1200px; */
	max-width: 850px;
	margin:auto;
	text-align: justify;
	    font-family: 'Roboto', sans-serif;
		color: #000;
		padding: 5px;
		position: relative;
}
.left:before {
    position: absolute;
    content: ":";
    right: 0px;
    top: -4px;
	display:inline-block;
}
p {
    font-size: 12px;
    padding: 0;
    margin: 0;
    margin-bottom: 5px;
    line-height: 15px;
	color: #000 !important;
}
.clearfix {
	display: block;
    width: 100%;
    clear: both;	
}
.sec-row p {
    margin: 0px;
    padding: 3px 5px;
    font-size: 12px;
    min-height: 17px;
}
.premium:before {
    position: absolute;
    content: ":";
    right: 0px;
    top: -2px;
	display: inline-block;
	    vertical-align: middle;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #000000 !important;
} 
.table thead th {
    vertical-align: middle;
    border-bottom: 1px solid #000000 !important;
	padding: 2px 2px !important;
}
.table {
    width: 100%;
    margin-bottom: 0 !important;
    color: #000000 !important;
}
.sec-row {
    height: 17px !important;
}
@media print {
body {-webkit-print-color-adjust: exact;}
}

@page {margin:1px;padding:1px;}

</style>


<div style="width: 100%;background-color: #cc3333;display: inline-block;margin-bottom: 9px;    padding: 3px;">
       
          <div style="display:inline-block;width:65%;display:inline-block;"><img src="img/logo.png" style="width: 120px;"></div>
          <div style="text-align:right;display:inline-block;width:35%;float:right;">
		  <h4 style="margin: 0;font-size: 20px;color: #fff;position: relative;top: 8px;
						margin-right: 29px;font-weight: 600;text-align: right">General Insurence</h4>
		  </div>
        
</div>
				<div class="clearfix"></div>
				
				<div class="heading-box" style="width: 100%;height: auto;float: left;text-align: center;display: inline-block;position: relative;">
					<h5 style="font-size: 14px;color: #cc0000;margin: 0;margin-bottom: 5px;font-weight: 600;">Kotak Long Term Wheeler Secure</h5>
					<span class="policy" style="font-size: 11px; margin-bottom: 3px; display: block;color: #000;">(Policy)</span>
					<h5 style="font-size: 14px;color: #cc0000;margin: 0;margin-bottom: 0px;font-weight: 600;">Certificate cum Policy Schedule</h5>
					<p style="color: #000; margin-bottom: 20px;">Policy/Certificate No:<?php echo $rmbinsurance_dtl[0]['rmb_policyno'];?></p>
					
					<div class="heading-scanner" style="width: auto;height: auto;float: left;">
					<!--<img src="img/96352-Ravi.png" style="position: absolute;width: 100px;right: 22px;top: -10px;">-->
					<img src="<?php echo $rmbinsurance_dtl[0]['rmb_qrcode_pic'];?>" style="position: absolute;width: 100px;right: 22px;top: -9px;">
				</div>
				</div>


<div style="width: 100%;display: block;height: auto;margin-right: 0%;">
				
					<div class="half-two" style="width: 49%;display:inline-block;float: right;margin-right: 2%;">
						<div class="blue" style="width: 100%;margin: 0;background-color: #003366;color: #fff;font-size: 14px;font-weight: 500;margin-bottom: 5px;">
						<h4 class="blue1" style="padding:  4px 20px; margin: 0;font-size: 14px; font-weight: 600;">INSURED DETAILS</h4></div>
						<div class="info" style="height: auto;display: inline-block;padding: 0px 15px;width:100%">
							<div class="left" style="width: 22%;float: left;display:inline-block;position: relative;margin-right: 3%;">
								<p style="margin: 0px;">Name</p>
							</div>
							<div class="right" style="width: 70%;float: left;display:inline-block;">
								<p style="font-size: 12px;margin: 0px;"><?php echo $rmbinsurance_dtl[0]['rmb_owner_name'];?></p>
							</div>
							
							<div class="clearfix"></div>
							<div class="left" style="width: 22%;float: left;position: relative;margin-right: 3%;display:inline-block;">
								<p style="margin: 0px; margin-bottom: 10px;">Address</p>
							</div>
							<div class="right" style="width: 70%;float: left;display:inline-block;">
								<p style="font-size: 12px;margin: 0px; margin-bottom: 10px;"><?php echo $rmbinsurance_dtl[0]['rmb_house_no'];?>,
								<?php echo $rmbinsurance_dtl[0]['rmb_vill_mandal'];?>,
								<?php echo $rmbinsurance_dtl[0]['rmb_district'];?>,
								<?php echo $rmbinsurance_dtl[0]['rmb_state'];?></p>
							</div>
							
							<div class="clearfix"></div>
							<div class="left" style="width: 22%;float: left;position: relative;margin-right: 3%;display:inline-block;">
								<p style="margin: 0px; margin-bottom: 0px;">Mobile No </p>
							</div>
							<div class="right" style="width: 70%;float: left;display:inline-block;"> 
								<p style="font-size: 12px;margin: 0px; margin-bottom: 0px;"></p>
							</div>
							
							<div class="clearfix"></div>
							<div class="left" style="width: 22%;float: left;position: relative;margin-right: 3%;display:inline-block;">
								<p style="margin: 0px;">Email</p>
							</div>
							<div class="right" style="width: 70%;float: left;display:inline-block;">
								<p style="font-size: 12px;margin: 0px;"><?php echo $rmbinsurance_dtl[0]['rmb_email_id'];?></p>
							</div> 
						</div>
					</div>
				
					<div class="half-two last" style="width: 48%;display:inline-block;margin-right: 0;">
						<div class="blue" style="width: 100%;margin: 0;background-color: #003366;color: #fff;font-size: 14px;font-weight: 500;margin-bottom: 5px;">
						<h4 class="blue1" style="padding:  4px 20px; margin: 0; font-size: 14px;font-weight:600;">POLICY DETAILS</h4></div>
						<div class="info" style="height: auto;display: inline-block;padding: 0px 15px;width: 100%;">
							<p style="color: #000;">Policy Issuing Office : Kotak Mahindra Bank Ltd. Vinay Bhavey
	Complex,4th-floor ,CST Road, Kalina, Santacruz-East Mumbai 400098</p>
							<p style="color: #000;">Valid From : <?php echo $rmbinsurance_dtl[0]['rmb_valid_from'];?>
							<span class="to" style="margin: 0px 10px;">To</span> <?php echo $rmbinsurance_dtl[0]['rmb_valid_to'];?> </p>
							
							<div class="half-double" style="width: 50%; float: left;display:inline-block;">
								<div class="left" style="width: 60%;margin-right:4%;float: left;position: relative;display:inline-block;">
									<p style="margin: 0px; margin-bottom: 0px;line-height: 13px;">Type Of Vehicle</p>
								</div>
								<div style="width: 36%;float: left;display:inline-block;">
									<p style="font-size: 12px;margin: 0px; margin-bottom: 0px;line-height: 13px;"><?php echo $rmbinsurance_catg[0]['category_code'];?></p>
								</div>
								
								<div class="clearfix"></div>
								<div class="left" style="width: 60%;margin-right:4%;float: left;position: relative;display:inline-block;">
									<p style="margin: 0px;line-height: 13px;">Policy issued on</p>
								</div>
								<div style="width: 36%;float: left;display:inline-block;">
									<p style="font-size: 12px;margin: 0px;line-height: 13px;"><?php echo date('Y-m-d',strtotime($rmbinsurance_dtl[0]['created_on']));?></p>
								</div>
							</div>
							
							<div class="half-double" style="width: 50%; float: left;display:inline-block;">
								<div class="left" style="width: 60%;margin-right:4%;float: left;position: relative;display:inline-block;">
									<p style="margin: 0px; margin-bottom: 0px;line-height: 13px;">Hypothecated</p>
								</div>
								<div style="width: 36%;float: left;display:inline-block;">
									<p style="font-size: 14px;margin: 0px; margin-bottom: 0px;line-height: 13px;">NA</p>
								</div>
								
								<div class="clearfix"></div>
								<div class="left" style="width: 60%;margin-right:4%;float: left;position: relative;display:inline-block;">
									<p style="margin: 0px;margin-bottom: 0px;line-height: 13px;">Cover Note No</p>
								</div>
								<div style="width: 36%;float: left;display:inline-block;">
									<p style="font-size: 14px;margin: 0px;margin-bottom: 0px;line-height: 13px;">NA</p>
								</div>
							</div>
						</div>
					</div>
				
				</div> 
				
			
				
				<div class="clearfix" style="margin-top: 0px;display: inline-block;"></div>
				
				<div class="blue" style="width: 100%;margin: 0;background-color: #003366;color: #fff;font-size: 14px;font-weight: 500;margin-bottom: 5px;"><h4 class="blue1" style="padding:  4px 20px; margin: 0; font-size: 14px;font-weight:600;">VEHICLE DETAILS</h4></div>
				<div class="info" style="height: auto;display: inline-block;padding: 0px 15px;width: 100%;">
				<div class="table" style="width: 100%; display: inline-block;margin: 0px;">
				
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="background-color: #b8b8b8;padding: 0px;"><p style="margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">Registration <br>No.</p></th>
								<th style="background-color: #b8b8b8;padding: 0px;"><p style="margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">Make</p></th>
								<th style="background-color: #b8b8b8;padding: 0px;"><p style="margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">Model</p></th>
								<th style="background-color: #b8b8b8;padding: 0px;"><p style="margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">Varient</p></th>
								<th style="background-color: #b8b8b8;padding: 0px;"><p style="margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">CC</p></th>
								<th style="background-color: #b8b8b8;padding: 0px;"><p style="margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">Manufacturing<br> Year</p></th>
								<th style="background-color: #b8b8b8;padding: 0px;"><p style="margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">Engine No</p></th>
								<th style="background-color: #b8b8b8;padding: 0px;"><p style="margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">Chassis No</p></th>
								<th style="background-color: #b8b8b8;padding: 0px;"><p style="margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">Seating <br>Capacity</p></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="background-color: #fff;padding: 0px;">
									<p style="padding: 5px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-size: 11px;"><?php echo $rmbinsurance_dtl[0]['rmb_registration_no'];?></p>
								</td>
								<td style="background-color: #fff;padding: 0px;">
									<p style="padding: 5px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-size: 11px;"><?php echo $rmbinsurance_dtl[0]['rmb_maker'];?></p>
								</td>
								<td style="background-color: #fff;padding: 0px;">
									<p style="padding: 5px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-size: 11px;"><?php echo $rmbinsurance_dtl[0]['rmb_model'];?></p>
								</td>
								<td style="background-color: #fff;padding: 0px;">
									<p style="padding: 5px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-size: 11px;">-</p>
								</td>
								<td style="background-color: #fff;padding: 0px;">
									<p style="padding: 5px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-size: 11px;">-</p>
								</td>
								<td style="background-color: #fff;padding: 0px;">
									<p style="padding: 5px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-size: 11px;"><?php echo $rmbinsurance_dtl[0]['rmb_mfg_year'];?></p>
								</td>
								<td style="background-color: #fff;padding: 0px;">
									<p style="padding: 5px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-size: 11px;"><?php echo $rmbinsurance_dtl[0]['rmb_engine_no'];?></p>
								</td>
								<td style="background-color: #fff;padding: 0px;">
									<p style="padding: 5px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-size: 11px;"><?php echo $rmbinsurance_dtl[0]['rmb_chessis_no'];?></p>
								</td>
								<td style="background-color: #fff;padding: 0px;">
									<p style="padding: 5px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-size: 11px;"><?php echo $rmbinsurance_dtl[0]['rmb_seat_capacity'];?></p>
								</td>
							</tr>
							
						</tbody>
					</table>

				</div>
				
				<div class="clearfix" style="margin-top: 2px;display: inline-block;"></div>
				<div class="clearfix"></div>
				<div class="table2" style="height: auto;display: inline-block;width: 100%;margin-bottom: 0px;">
				
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th colspan="8" style="background-color: #b8b8b8;padding: 0px;">
									<p style="padding: 0px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">Insured Declared Value(IDV)</p>
								</th>
							</tr>
							<tr>
								<th style="background-color: #b8b8b8;padding: 0px;">
									<p style="padding: 0px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">Period</p>
								</th>
								<th style="background-color: #b8b8b8;padding: 0px;">
									<p style="padding: 0px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">Insured Declared Value(IDV) of the Vehicle (in Rs.) </p>
								</th>
								<th style="background-color: #b8b8b8;padding: 0px;">
									<p style="padding: 0px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">IDB of Side car (in Rs.) </p></div>
								</th>
								<th style="background-color: #b8b8b8;padding: 0px;">
									<p style="padding: 0px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">Additional Accessories (in Rs.) </p>
								</th>
								<th style="background-color: #b8b8b8;padding: 0px;">
									<p style="padding: 0px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">Non- Electrical Accessories Fitted of the Vehicle (in Rs.)</p>
								</th>
								<th style="background-color: #b8b8b8;padding: 0px;">
									<p style="padding: 0px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">Electrical&Electronic Accessories Fitted to the Vehicle (in Rs.)</p>
								</th>
								<th style="background-color: #b8b8b8;padding: 0px;">
									<p style="padding: 0px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">CNG / LPG Kit (in Rs.) </p>
								</th>
								<th style="background-color: #b8b8b8;padding: 0px;">
									<p style="padding: 0px 0px;margin: 0;text-align: center;width: -webkit-fill-available;font-weight: 600;font-size: 11px;">Total Value of the Vehicle (in Rs.) </p>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="background-color: #fff;padding: 0px;">
									<p style="margin: 0;text-align: center;font-size: 11px;">0</p>
								</td>
								<td style="background-color: #fff;padding: 0px;">
									<p style="margin: 0;text-align: center;font-size: 11px;">0</p>
								</td>
								<td style="background-color: #fff;padding: 0px;">
									<p style="margin: 0;text-align: center;font-size: 11px;">0</p>
								</td>
								<td style="background-color: #fff;padding: 0px;">
									<p style="margin: 0;text-align: center;font-size: 11px;">0</p>
								</td>
								<td style="background-color: #fff;padding: 0px;">
									<p style="margin: 0;text-align: center;font-size: 11px;">0</p>
								</td>
								<td style="background-color: #fff;padding: 0px;">
									<p style="margin: 0;text-align: center;font-size: 11px;">0</p>
								</td>
								<td style="background-color: #fff;padding: 0px;">
									<p style="margin: 0;text-align: center;font-size: 11px;">0</p>
								</td>
								<td style="background-color: #fff;padding: 0px;">
									<p style="margin: 0;text-align: center;font-size: 11px;">0</p>
								</td>
							</tr>
							
						</tbody>
					</table>
				
					
				</div>	
				</div> 
				
				
				<div class="clearfix margin-top10" style="margin-top: 5px;display: inline-block;"></div>
				<div class="clearfix"></div>
				
				<div class="blue" style="width: 100%;margin: 0;background-color: #003366;color: #fff;font-size: 14px;font-weight: 500;margin-bottom: 0px;">
					<h4 class="blue1" style="padding:  4px 20px; margin: 0;font-size: 14px;font-weight:600;">PREMIUM COMPUTATION TABLE(IN Rs.)</h4></div>
				
				<div class="clearfix"></div>
				<div class="info" style="height: auto;display: inline-block;padding: 0px 15px;width: 100%;">
					<div style="height: auto;display: inline-block;width: 100%;">
						<div class="section1" style="width: 50%;display: inline-block; border-right: 1px solid #000;">
							<div class="line" style="width: 100%;border: 1px solid #000;border-right:0px;border-bottom: none;display: inline-block;">
								<p style="width: 100%;margin: 0px;text-align: center;border-bottom: 1px solid #000;padding: 2px;font-weight: 600;display: inline-block;">Section-I </p>
								
								<div class="clearfix"></div>
								<div class="sec-row" style="border-bottom: 1px solid #000;display: inline-block;width: 100%;">
									<div style="width: 68%;float: left;display: inline-block;"><p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;font-weight: 600;">Own Damage </p></div>
									<div style="width: 30%;float: left;border-left: 1px solid #000;text-align: right;display: inline-block;">
									<p style="font-weight: 600;height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;">NA</p></div>
								</div>
								
								<div class="clearfix"></div>
								<div class="sec-row" style="border-bottom: 1px solid #000;display: inline-block;width: 100%;">
									<div style="width: 68%;float: left;display: inline-block;"><p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;color: #000;">Basic Own Damage </p></div>
									<div style="width: 30%;float: left;border-left: 1px solid #000;text-align: right;display: inline-block;">
									<p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;">NA</p></div>
								</div>
								<div class="clearfix"></div>
								<div class="sec-row" style="border-bottom: 1px solid #000;display: inline-block;width: 100%;">
									<div style="width: 68%;float: left;display: inline-block;"><p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;">Depreciation Cover</p></div>
									<div style="width: 30%;float: left;border-left: 1px solid #000;text-align: right;display: inline-block;">
									<p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;">NA</p></div>
								</div>
								<div class="clearfix"></div>
								<div class="sec-row" style="border-bottom: 1px solid #000;display: inline-block;width: 100%;">
									<div style="width: 68%;float: left;display: inline-block;"><p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;">Less</p></div>
									<div style="width: 30%;float: left;border-left: 1px solid #000;text-align: right;display: inline-block;"><p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;"></p></div>
								</div>
								<div class="clearfix"></div>
								<div class="sec-row" style="border-bottom: 1px solid #000;display: inline-block;width: 100%;">
									<div style="width: 68%;float: left;display: inline-block;"><p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;">Bonus Percent NA</p></div>
									<div style="width: 30%;float: left;border-left: 1px solid #000;text-align: right;display: inline-block;">
									<p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;">NA</p></div>
								</div>
								<div class="clearfix"></div>
								<div class="sec-row" style="border-bottom: 1px solid #000;display: inline-block;width: 100%;outline: none;">
									<div style="width: 68%;float: left;display: inline-block;"><p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;font-weight: 600;">Total Own Damage Premium(A)</p></div>
									<div style="width: 30%;float: left;border-left: 1px solid #000;text-align: right;display: inline-block;"><p style="font-weight: 600;height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;">NA</p></div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="section1" style="width: 49%; display: inline-block;float: right;">
							<div class="line" style="width: 100%; border: 1px solid #000;border-bottom: none;display: inline-block;">
								<p class="sec-title strong" style="margin: 0px;text-align: center;border-bottom: 1px solid #000;padding: 2px;font-weight: 600;">Section-II </p>
								<div class="sec-row" style="border-bottom: 1px solid #000;display: inline-block;width: 100%;">
									<div style="width: 68%;float: left;display: inline-block;"><p style="font-weight: 600;height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;">Liability</p></div>
									<div style="width: 30%;float: left;border-left: 1px solid #000;text-align: right;display: inline-block;">
									<p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;"></p></div>
								</div>
								<?php 
								number_format($b, 2, '.', '');
								$basic_TP=number_format(1550,2,'.','');$PA_cover=number_format(50,2,'.','');
								if($rmbinsurance_catg[0]['category_code']=='2W')
								{
									$basic_TP=number_format(720,2,'.','');
								}
								$TP_PA=number_format(($basic_TP+$PA_cover),2,'.','');
								$GST=($TP_PA*18)/100; $GST=number_format($GST,2,'.','');
								$premium=number_format(($TP_PA+$GST),2,'.','');
								?>
								<div class="clearfix"></div>
								<div class="sec-row" style="border-bottom: 1px solid #000;display: inline-block;width: 100%;">
									<div style="width: 68%;float: left;display: inline-block;"><p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;">Basic TP Including TPPD Premium</p></div>
									<div style="width: 30%;float: left;border-left: 1px solid #000;text-align: right;display: inline-block;">
									<p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;"><?php echo $basic_TP;?></p></div>
								</div>
								
								<div class="clearfix"></div>
								<div class="sec-row" style="border-bottom: 1px solid #000;display: inline-block;width: 100%;">
									<div style="width: 68%;float: left;display: inline-block;"><p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;">PA Cover for Owner Driver of 0</p></div>
									<div style="width: 30%;float: left;border-left: 1px solid #000;text-align: right;display: inline-block;">
									<p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;"><?php echo $PA_cover;?></p></div>
								</div>
								
								<div class="clearfix"></div>
								<div class="sec-row" style="border-bottom: 1px solid #000;display: inline-block;width: 100%;">
									<div style="width: 68%;float: left;display: inline-block;"><p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;"></p></div>
									<div style="width: 30%;float: left;border-left: 1px solid #000;text-align: right;display: inline-block;"><p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;">&nbsp;</p></div>
								</div>
								
								<div class="clearfix"></div>
								<div class="sec-row" style="border-bottom: 1px solid #000;display: inline-block;width: 100%;">
									<div style="width: 68%;float: left;display: inline-block;"><p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;"></p></div>
									<div style="width: 30%;float: left;border-left: 1px solid #000;text-align: right;display: inline-block;"><p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;">&nbsp;</p></div>
								</div>
								
								<div class="clearfix"></div>
								<div class="sec-row" style="border-bottom: 1px solid #000;display: inline-block;width: 100%;outline: none;">
									<div style="width: 68%;float: left;display: inline-block;"><p style="height: 17px;font-weight: 600;margin: 0px;padding: 0px 5px;font-size: 11px;">Total Liability Premium(B)</p></div>
									<div style="width: 30%;float: left;border-left: 1px solid #000;text-align: right;display: inline-block;">
									<p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;"><?php echo $TP_PA;?></p></div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div> 
					</div> 
					<div class="clearfix"></div>
					
					<div class="section1" style="width: 99.7%;height: auto;display: inline-block;">
						<div class="line" style="width: 100%;border: 1px solid #000;border-top: 0;border-bottom: none;">
							<div class="sec-row" style="width: 100%;border-bottom: 1px solid #000;display: inline-block;">
								<div style="width: 68%;float: left;display: inline-block;"><p style="height: 17px;font-weight: 600;margin: 0px;padding: 0px 5px;font-size: 11px;">Taxable Value of Service(A+B)</p></div>
								<div style="width: 31%;float: left;text-align: right;display: inline-block;"><p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;"></p></div>
							</div>
							
							<div class="clearfix"></div>
							<div class="sec-row" style="width: 100%;border-bottom: 1px solid #000;display: inline-block;">
								<div style="width: 68%;float: left;display: inline-block;"><p style="height: 17px;font-weight: 600;margin: 0px;padding: 0px 5px;font-size: 11px;">IGST @18.0 %</p></div>
								<div style="width: 31%;float: left;text-align: right;display: inline-block;"><p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;"><?php echo $GST;?></p></div>
							</div>
							
							<div class="clearfix"></div>
							<div class="sec-row" style="width: 100%;border-bottom: 1px solid #000;display:  inline-block;">
								<div style="width: 68%;float: left;display: inline-block;"><p style="height: 17px;font-weight: 600;margin: 0px;padding: 0px 5px;font-size: 11px;">Total Premium (in Rs.) </p></div>
								<div style="width: 31%;float: left;text-align: right;display: inline-block;">
								<p style="height: 17px;margin: 0px;padding: 0px 5px;font-size: 11px;"><?php echo $premium;?></p></div>
							</div>
						</div>
					</div> 
					 
					<div class="clearfix" style="margin-top: 4px;display: inline-block;"></div> 
					
					<div class="clearfix"></div>
					
					<div style="width: 100%;float: left;display: inline-block;height: auto;">
						<div class="clearfix"></div>
						<div class="field-left" style="width: 55%;float: left;display: inline-block;">
							<p class="box-left" style="width: 30%;float: left;display: inline-block;margin-top: 2px;margin-bottom: 0;">Geographical Area</p>
							<p style="width: 50%;float: left;border: 1px solid #000;margin: 0px;padding: 1px 10px;display: inline-block;    outline: none; box-shadow: none;">India</p>
						</div>
						<div class="field-right" style="width: 40%;float: left;display: inline-block;">
							<p class="box-left" style="width: 40%;float: left;margin-top: 2px;margin-bottom: 0;display: inline-block;">Additional Excess Rs</p>
							<p style="width:50%;float: left;border: 1px solid #000;margin: 0px;padding: 1px 10px;text-align: right;display: inline-block;">0</p>
						</div>
					</div>
					
					
					<div class="clearfix margin-top10"></div> 
					
					<div style="width: 100%;float: left;display: inline-block; height: auto;">
						<div class="three-box">
							<div class="three-box1" style="width: 38%;float: left;margin-right: 2%;display: inline-block;">
								<p style="width: 58%;float: left;padding-right: 10px;margin-top: 2px;margin-bottom: 0;display: inline-block;">Compulsory Deductibles Rs. </p>
								<p style="width: 30%;float: left;border: 1px solid #000;margin: 0px;padding: 1px 10px;display: inline-block;"><?php echo number_format(($rmbinsurance_catg[0]['price']),2,'.','');?></p>
							</div>
							<div class="three-box2" style="width: 28%;float: left;margin-right: 2%;display: inline-block;">
								<p style="width: 70%;float: left;padding-right: 10px;margin-top: 2px;margin-bottom: 0;display: inline-block;">Voluntary Deductibles Rs.</p>
								<p style="width: 20%;float: left;border: 1px solid #000;margin: 0px;padding: 1px 10px;text-align: right;display: inline-block;">0</p>
							</div>
							<div class="three-box3" style="width: 28%;float: left;display: inline-block;">
								<p style="width: 50%;float: left;padding-right: 10px;margin-top: 2px;margin-bottom: 0;display: inline-block;">Total Deductible Rs.</p>
								<p style="width: 30%;float: left;border: 1px solid #000;margin: 0px;padding: 1px 10px;text-align: right;display: inline-block;"><?php echo number_format(($rmbinsurance_catg[0]['price']),2,'.','');?></p>
							</div>
						</div> 
					
					</div>  
					<div class="clearfix"></div>
					
				</div>
				
				<div class="blue" style="width: 100%;margin: 0;background-color: #003366;color: #fff;font-size: 14px;font-weight: 500;margin-bottom: 5px;margin-top: 0px;">
					<h4 class="blue1" style="padding:  4px 20px; margin: 0;font-size: 14px;font-weight:600;">INTERMEDIARY DETAILS </h4></div>
					<div class="clearfix"></div>
					
				<div style="height: auto;display: inline-block;padding: 0px 15px;width: 100%;">
					<ul style="width: 50%;margin: 0px;padding: 0px;display: inline-block;margin-right: 5%; margin-bottom: 0px;">
						<li style="width: 30%;border: none;
    padding: 0px;
    position: relative;
    margin-top: -3px;
    font-size: 13px;display: inline-block;
    float: left;
    list-style: none;">Intermediary Code</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
    width: 9px; line-height: 17px;
    height: 20px;">3</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
   width: 9px;line-height: 17px;
    height: 20px;">1</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
   width: 9px;line-height: 17px;
    height: 20px;">6</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
   width: 9px;line-height: 17px;
    height: 20px;">0</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
   width: 9px;line-height: 17px;
    height: 20px;">6</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
   width: 9px;line-height: 17px;
    height: 20px;">6</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
   width: 9px;line-height: 17px;
    height: 20px;">0</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
   width: 9px;line-height: 17px;
    height: 20px;">0</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
   width: 9px;line-height: 17px;
    height: 20px;">0</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
   width: 9px;line-height: 17px;
    height: 20px;">0</li>
					</ul>
					<ul  style="width: 45%;margin: 0px;padding: 0px;display: inline-block;margin-right: 0px;float: right; margin-bottom: 0px;">
						<li style=" width: 33%;border: none;
    padding: 0px;
    position: relative;
    margin-top: -3px;
    font-size: 13px;display: inline-block;
    float: left;
    list-style: none;">Intermediary Name</li>
						<li style="width: 64%;display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left; height: 20px; line-height: 15px;
   ">Coverfox Insurance Broking Pvt. Ltd</li>
					</ul>
					<div class="clearfix" style="margin-top: 5px; display: inline-block;"></div>
					<div class="clearfix"></div>
					
				<ul  style="width: 49%;margin-top: 0px;padding: 0px;display: inline-block;margin-right: 2%;margin-bottom: 0px;">
						<li style="width: 40%;border: none;
    padding: 0px;
    position: relative;
    margin-top: -3px;
    font-size: 13px;display: inline-block;
    float: left;
    list-style: none;">Intermediary 's Mobile No</li>
						<li style="width:  1%;display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;line-height: 17px;
    float: left; height: 20px;">-</li>
						<li style="width:  1%;display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;line-height: 17px;
    float: left; height: 20px;
    ">-</li>
						<li style="width:  1%;display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;line-height: 17px;
    float: left; height: 20px;
    ">-</li>
						<li style="width:  1%;display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;line-height: 17px;
    float: left; height: 20px;
    ">-</li>
						<li style="width:  1%;display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;line-height: 17px;
    float: left; height: 20px;
    ">-</li>
						<li style="width:  1%;display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;line-height: 17px;
    float: left; height: 20px;
  ">-</li>
						<li style="width:  1%;display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;line-height: 17px;
    float: left; height: 20px;
    ">-</li>
						<li style="width:  1%;display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;line-height: 17px;
    float: left; height: 20px;
    ">-</li>
						<li style="width:  1%;display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;line-height: 17px;
    float: left; height: 20px;
    ">-</li>
						<li style="width:  1%;display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;line-height: 17px;
    float: left; height: 20px;
    ">-</li>
					</ul>
					
					<ul style="width: 49%;margin-top: 1px;
    padding: 0px;
    display: inline-block;
    margin-right: 10px;margin-right: 0px;margin-bottom: 0px;">
						<li style="width: 42%; border: none;
    padding: 0px;
    position: relative;
    margin-top: -3px;
    font-size: 13px;display: inline-block;
    float: left;
    list-style: none;">Intermediary 's Landline No</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
    width: 1%;line-height: 17px;
    height: 20px;">3</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
     width: 1%;line-height: 17px;
    height: 20px;">3</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
     width: 1%;line-height: 17px;
    height: 20px;">3</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
     width: 1%;line-height: 17px;
    height: 20px;">3</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
     width: 1%;line-height: 17px;
    height: 20px;">3</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
     width: 1%;line-height: 17px;
    height: 20px;">3</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
  width: 1%;line-height: 17px;
    height: 20px;">3</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
    width: 1%;line-height: 17px;
    height: 20px;">3</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
  width: 1%;line-height: 17px;
    height: 20px;">3</li>
						<li style="display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    padding: 0px 6px;
    float: left;
    width: 1%;line-height: 17px;
    height: 20px;">3</li>
					</ul> 
				</div>
				
				<div class="clearfix"></div>	
					
				<div class="blue" style="width: 100%;margin: 0;background-color: #003366;color: #fff;font-size: 14px;font-weight: 500;margin-bottom: px;">	
					<h4 class="blue1" style="padding:  4px 20px; margin: 0;font-size: 14px;font-weight:600;">DISCLAIMER</h4></div>	
				<div style="height: auto;display: inline-block;padding: 0px 15px;width: 100%;">	
					<p style="margin-bottom: 5px;">For complete details on terms and conditions governing the coverage and NCB Please read the policy wordings . This document is to be read with \nthe policy wordings . Please refer to the claim from for necessary documents to be submitted for processing the claim.</p>	
				</div>
				
				<div style="width: 100%;background-color: #b8b8b8; margin-top: 1px;position: relative;margin-bottom: 0px;">
					<div style="padding: 2px;">
						<p style="font-size: 10px;text-align: center;margin-bottom: 0px;">Kotak Mahindra General Insurancy company Limited (Formerty Kotak Mahindra General Insurance Limited)</p>
						<p style="font-size: 10px;text-align: center;margin-bottom: 0px;">CIN:U66000MH2014PXC260291, Registered Office: 27BKC,C27,G Block,Bandra Kurla Complex,Bandra East ,Mumbai 400051, Maharashtra ,India</p>
						<p style="font-size: 10px;text-align: center;margin-bottom: 0px;">Office : 8th floor ,Zone IV ,Kotak Infinity IT Park Of Western Express Highway general AK,Vaidya Marg, Dindoshi,Malad(E),Mumbai 400097.India.</p>
						<p style="font-size: 10px;text-align: center;margin-bottom: 0px;">Toll free: 18002664545 email care@kotak.com website:www.kotakgeneralinsurancy.com IRDAI Reg.No.152</p>
					</div>
				</div>
				
				
				<div class="clearfix"></div>
				<div style="width: 100%;background-color: #cc3333;display: inline-block;padding: 3px;height: auto;">
       
						  <div style="display:inline-block;width:65%;display:inline-block;"><img src="img/logo.png" style="width: 120px;"></div>
						  <div style="text-align:right;display:inline-block;width:35%;float:right;">
						  <h4 style="margin: 0;font-size: 20px;color: #fff;position: relative;top: 8px;margin-right: 29px;font-weight: 600;text-align: right">General Insurence</h4>
						  </div>
						  <div class="clearfix"></div>
						
				</div>
				
				
				
				<div class="clearfix margin-top10" style="margin-top: 10px;display: inline-block;"></div> 
				
				
				<div class="clearfix margin-top10" style="margin-top: 10px;display: inline-block;"></div> 
				<div class="blue" style="width: 100%;margin: 0;background-color: #003366;color: #fff;font-size: 14px;font-weight: 500;margin-bottom: 10px;">
					<h4 class="blue1" style="padding:  4px 20px; margin: 0;font-size: 14px;font-weight:600;">IMPORTANT NOTICE </h4></div>
				<div style="height: auto;display: inline-block;padding: 0px 15px;width: 100%;">
					<p>The insured is not indemnified if the vehicle is used or driven otherwise than in accordance with this Schedule . Any payment made by the
					Company by reason of wider terms appearing in the Policy in order to comply with the Motor Vehicle Act . 1988 is recoverable from the
					insured . See the clause headed <span style="margin: 0px 10px;">AVOIDANCE OF CERTAIN TERMS AND RIGHT OF RECOVERY</span> . For legal interpretation , English
					version will hold good .
					</p>
					<div class="clearfix margin-top10" style="margin-top: 10px;display: inline-block;"></div> 
					<div class="clearfix"></div>
					
					<div class="premium" style="width: 22%;float: left;position: relative;margin-right: 3%;display: inline-block;">
						<p>Premium Collection Details </p>
					</div>
					<div style="width: 75%;float: left;display: inline-block;">
						<p></p>
					</div>	
					
					<div class="clearfix"></div>
					<div class="premium" style="width: 22%;float: left;position: relative;margin-right: 3%;display: inline-block;">
						<p>Collection No </p>
					</div>
					<div style="width: 75%;float: left;display: inline-block;">
						<p>LHMP607896771116 </p>
					</div>
					
					<div class="clearfix"></div>
					<div class="premium" style="width: 22%;float: left;position: relative;margin-right: 3%;display: inline-block;">
						<p>Receipt Date </p>
					</div>
					<div style="width: 75%;float: left;display: inline-block;">
						<p> <?php echo date('d/M/Y',strtotime($rmbinsurance_dtl[0]['created_on']));?> </p>
					</div>
					
					<div class="clearfix margin-top10" style="margin-top: 10px;display: inline-block;"></div> 
					<p>Subject to I.M.T.Endt.Nos. & Memorandum 22 Printed/herein/attached here to Under Hire Purchase Agreement with NA </p>
						
				</div>
				
				<div class="clearfix margin-top10" style="margin-top: 10px;display: inline-block;"></div> 
				<div class="clearfix"></div>
				<div class="blue" style="width: 100%;margin: 0;background-color: #003366;color: #fff;font-size: 14px;font-weight: 500;margin-bottom: 10px;">
					<h4 class="blue1" style="padding:  4px 20px; margin: 0;font-size: 14px;font-weight:600;">TAX DETAILS </h4></div>
				<div style="height: auto;display: inline-block;padding: 0px 15px;width: 100%;">
					<ul class="line-box" style="width: 67%; margin: 0px;
    padding: 0px; margin-bottom: 5px;
    display: inline-block;
    margin-right: 0px;">
						<li class="text" style="width: 37%; border: none;
    padding: 0px;
    position: relative;
     margin-top: -2px;
    font-size: 13px;
    display: inline-block;
    float: left;
    list-style: none;margin-right: 0px;">Service Tax/GST Registration No</li>
						<li style="display: inline-block;
    font-size: 14px;
    border: 1px solid #000;
	text-align: center;
	padding: 0px 0px;
    float: left;
    width: 3%;
    height: 20px;    line-height: 17px;
">2</li>
						<li style="display: inline-block;
    font-size: 14px;
    border: 1px solid #000;
    padding: 0px 0px;
	text-align: center;
    float: left;
    width:  3%;
    height: 20px; line-height: 17px;
">7</li>
						<li style="display: inline-block;
    font-size: 14px;
    border: 1px solid #000;
    padding: 0px 0px;
	text-align: center;
    float: left;
    width:  3%;
    height: 20px;line-height: 17px;
">6</li>
						<li style="display: inline-block;
    font-size: 14px;
    border: 1px solid #000;
    padding: 0px 0px;
	text-align: center;
    float: left;
    width:  3%;
    height: 20px;line-height: 17px;
">0</li>
						<li style="display: inline-block;
    font-size: 14px;
    border: 1px solid #000;
    padding: 0px 0px;
	text-align: center;
    float: left;
    width: 3%;
    height: 20px;line-height: 17px;
">6</li>
						<li style="display: inline-block;
    font-size: 14px;
    border: 1px solid #000;
    padding: 0px 0px;
	text-align: center;
    float: left;
    width:  3%;
    height: 20px;line-height: 17px;
">6</li>
						<li style="display: inline-block;
    font-size: 14px;
    border: 1px solid #000;
    padding: 0px 0px;
	text-align: center;
    float: left;
    width:  3%;
    height: 20px;line-height: 17px;
">0</li>
						<li style="display: inline-block;
    font-size: 14px;
    border: 1px solid #000;
    padding: 0px 0px;
	text-align: center;
    float: left;
    width:  3%;
    height: 20px;line-height: 17px;
">0</li>
						<li style="display: inline-block;
    font-size: 14px;
    border: 1px solid #000;
    padding: 0px 0px;
	text-align: center;
    float: left;
    width:  3%;
    height: 20px;line-height: 17px;
">0</li>
						<li style="display: inline-block;
    font-size: 14px;
    border: 1px solid #000;
    padding: 0px 0px;
	text-align: center;
    float: left;
    width:  3%;
    height: 20px;line-height: 17px;
">0</li>
						<li style="display: inline-block;
    font-size: 14px;
    border: 1px solid #000;
    padding: 0px 0px;
	text-align: center;
    float: left;
    width:  3%;
    height: 20px;line-height: 17px;
">0</li>
						<li style="display: inline-block;
    font-size: 14px;
    border: 1px solid #000;
    padding: 0px 0px;
	text-align: center;
    float: left;
    width:  3%;
    height: 20px;line-height: 17px;
">0</li>
						<li style="display: inline-block;
    font-size: 14px;
    border: 1px solid #000;
    padding: 0px 0px;
	text-align: center;
    float: left;
    width:  3%;
    height: 20px;line-height: 17px;
">0</li>
						<li style="display: inline-block;
    font-size: 14px;
    border: 1px solid #000;
    padding: 0px 0px;
	text-align: center;
    float: left;
    width:  3%;
    height: 20px;line-height: 17px;
">0</li>
						<li style="display: inline-block;
    font-size: 14px;
    border: 1px solid #000;
    padding: 0px 0px;
	text-align: center;
    float: left;
    width:  3%;
    height: 20px;line-height: 17px;
">0</li>
					</ul>
					
					
					<ul style=" width: 32%;margin: 0px;padding: 0px;display: inline-block;margin-right: 0%;margin-bottom: 10px;">
						<li style="width: 22%;border: none;
    padding: 0px;
    margin-right: 0px;
    position: relative;
    margin-top: -3px;
    font-size: 13px;
    display: inline-block;
    float: left;
    list-style: none;">Category</li>
						<li style="width: 72%; display: inline-block;
    font-size: 12px;
    border: 1px solid #000;
    position: relative;margin-top: 10px;
    padding: 2px 6px; margin-right: 0%; height: 18px; color: #000;    line-height: 14px;
    float: left;">General Insurence Service pvt Ltd.</li>
					</ul>
					
					<div class="clearfix"></div>
					<ul style="width: 66%;margin: 0px;padding: 0px;display: inline-block;margin-bottom: 10px;">
						<li style="border: none;
    padding: 0px;
    margin-right: 15px;
    position: relative;
    margin-top: -3px;
    font-size: 13px;
    display: inline-block;
    list-style: none;width: 34%">SAC</li>
						<li style="    display: inline-block;
    font-size: 12px;
    border: 1px solid #000 !important; outline: none;margin-top: 10px;
    position: relative;
    padding: 2px 6px;  height: 18px; color: #000; line-height: 14px;
    float: left;width: 54%"> 9971</li>
					</ul>
					
					
					<ul style="width: 30%; margin: 0px;padding: 0px;display: inline-block;margin-right: 0px;margin-bottom: 10px;">
						<li  style="width: 23%;border: none;
    padding: 0px;
    margin-right: 10px;
    position: relative;
    margin-top: -3px;
    font-size: 13px;
    display: inline-block;
    float: left;
    list-style: none;">Description</li>
						<li style="width: 77%;display: inline-block;
    font-size: 12px;
    border: 1px solid #000; outline: none;
    position: relative;margin-top: 10px;
    padding: 2px 6px; height: 18px; color: #000; line-height: 14px;
    float: left;">Motor Vehicle Insurance Service </li>
					</ul>
					
				</div>
				
				
				<div class="clearfix margin-top20" style="margin-top: 5px;display: inline-block;"></div> 
				<div class="clearfix"></div>
				<div class="blue" style="width: 100%;margin: 0;background-color: #003366;color: #fff;font-size: 14px;font-weight: 500;margin-bottom: 10px;">
					<h4 class="blue1" style="padding:  4px 20px; margin: 0;font-size: 14px;font-weight:600;">DECLARATION</h4></div>
				<div style="height: auto;display: inline-block;padding: 0px 15px;width: 100%; margin-bottom: 120px;">
					<p>I/We hereby certify that the policy to which the certificate relates as well as the certificate of insurance are issued in accordance with the
provision of chapter X,XI of M.V .Act 1988</p>

					<p>In Witness whereof this Ploicy has been signed for and behalf of Kotak Mahindra Bank Ltd. Vinay Bhaveya Complex , 4th floor , CST Road
, Kalina , Santacruz- East Mumbai â€“ 400098</p>
					<p>Rs. 0.50 for this policy paid as part of consolidated Stamp Duty Payment.</p>
					<p>For Kotak Mahindra General Insurance Company Limited</p>
					
					
					<div style="width: 52%;margin-left: 5%;">
						<img src="img/sign.jpg" style="width: 150px;margin-top: 30px;">
						<p>Authorise Signatory </p>
						<p>This document is digitally signed, hence counter signature / stamp is not required</p>
					</div>
					
				</div>
				
				
				
				
				
				
				<div style="width: 100%;background-color: #b8b8b8; margin-top: 20px;position: absolute;bottom: 52px;">
					<div style="padding: 5px;">
						<p style="font-size: 10px;text-align: center;margin-bottom: 0px;">Kotak Mahindra General Insurancy company Limited (Formerty Kotak Mahindra General Insurance Limited)</p>
						<p style="font-size: 10px;text-align: center;margin-bottom: 0px;">CIN:U66000MH2014PXC260291, Registered Office: 27BKC,C27,G Block,Bandra Kurla Complex,Bandra East ,Mumbai 400051, Maharashtra ,India</p>
						<p style="font-size: 10px;text-align: center;margin-bottom: 0px;">Office : 8th floor ,Zone IV ,Kotak Infinity IT Park Of Western Express Highway general AK,Vaidya Marg, Dindoshi,Malad(E),Mumbai 400097.India.</p>
						<p style="font-size: 10px;text-align: center;margin-bottom: 0px;">Toll free: 18002664545 email care@kotak.com website:www.kotakgeneralinsurancy.com IRDAI Reg.No.152</p>
					</div>
				</div>
				
				
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>




<?php

  echo $html = ob_get_clean();
 
$dompdf = new Dompdf();
$dompdf->load_html($html);
$dompdf->render();
$file=$dompdf->output();
$verified_CID=$rmbinsurance_dtl[0]['rmb_registration_no']."-".rand(100,99999);
$filename=$verified_CID.'.pdf';

file_put_contents($filename,$file);
$uploadpath="./";
 $file_url=$uploadpath.$filename;
//update agreement path into table
$sqlinsert=mysqli_query($connection,"update rmb_insurance_dtl SET rmb_agreement='$filename' where id='$regID'");
?>
<a download="" href="<?php echo $rmbbasicdetls[0]['base_path'];?>/financial-admin/qrcode/agreement-pdf/<?php echo $filename;?>" class="btn btn-primary newregbtn">Download</a>
<?php
//header("Location: https://rmbwebsolutions.com/projects/Financial/financial-admin/qrcode/agreement-pdf/".$filename);
}
else{
	$filename=$rmb_agreement;
	header("Location: https://rmbwebsolutions.com/projects/Financial/financial-admin/qrcode/agreement-pdf/".$filename);
}

/*echo $file_url = 'http://localhost/F/Financial-web/financial-admin/qrcode/agreement-pdf/' . $filename;
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"".$filename."\""); 
readfile($file_url);
exit;*/ 


/*if(file_exists($filename)){
header('Content-Description: File Transfer');
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="'.$filename.'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filename));
flush(); // Flush system output buffer
readfile($filename);
die();
} else {
http_response_code(404);
die();
}
*/

?>