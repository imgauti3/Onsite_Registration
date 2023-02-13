<?php
ob_start();
session_start();
include('libs/phpqrcode/qrlib.php'); 
include_once"../dbconfig.php";

if($_POST['ajaxtype']=='Insuranceregistration')
{
	
	
	//valid from to generation
	$fromdate=date('Y-m-d');
	$todate = date('Y-m-d', strtotime('+1 year'));
	$todate=date('Y-m-d', strtotime('-1 days', strtotime($todate)));
	//insert into insurance table
	$checkemailforgot=mysqli_query($connection,"insert into rmb_insurance_dtl(rmb_category_id,rmb_policyno,rmb_valid_from,rmb_valid_to,
	rmb_registration_no,rmb_owner_name,rmb_total_vec_value,rmb_house_no,rmb_vill_mandal,rmb_district,rmb_seat_capacity,rmb_state,
	rmb_maker,rmb_model,rmb_mfg_year,rmb_engine_no,rmb_chessis_no,rmb_email_id,status,created_on,created_by)values
	('".$_POST['vechiltype']."','$newpolicyID','$fromdate','$todate','".$_POST['regnumber']."','".$_POST['vec_ownername']."','".$_POST['vec_totalvalue']."',
	'".$_POST['vec_houseno']."','".$_POST['vec_village']."',
	'".$_POST['vec_district']."','".$_POST['vec_seatcap']."','".$_POST['vec_state']."','".$_POST['vec_maker']."','".$_POST['vec_model']."',
	'".$_POST['vec_mfgyear']."','".$_POST['vec_engineno']."','".$_POST['vec_chassisno']."','".$_POST['vec_owneremail']."',
	'Active','".date('Y-m-d H:i:s')."','".$_SESSION['user_finid']."')");   
	
	$lastinsertid=mysqli_insert_id($connection);
	
	
	//generate QR image start
	$tempDir = 'agreement-pdf/qrimages/'; 
	$qrimage = $_POST['regnumber']."-".$_POST['vec_ownername'];
	//$codeContents = $rowpolicybasic['base_path']."/regDetails.php?regID=".base64_encode($lastinsertid); 
	$codeContents=htmlentities("REG NO: ".$_POST['regnumber']." \nOWNER NAME: ".$_POST['vec_ownername']." \nMFG YEAR: ".$_POST['vec_mfgyear']." \nCHASSIS NO: ".$_POST['vec_chassisno']." \nENGINE NO: ".$_POST['vec_engineno']." \nVALID  DATE: ".$fromdate." TO ".$todate.".");
	QRcode::png($codeContents, $tempDir.''.$qrimage.'.png', QR_ECLEVEL_L, 5);
	$qrimagepath="qrimages/".$qrimage.".png";
	//generate QR image end 
	//include_once"agreement-pdf/insurance_agreement.php";
	//update record with qrimage path
	$checkemailforgot=mysqli_query($connection,"update rmb_insurance_dtl SET rmb_qrcode_pic='$qrimagepath' where id='$lastinsertid'");
	
	if($lastinsertid)
	{
   	   echo base64_encode($lastinsertid);
	}
	else
	{
		echo "FAILEDREG";
	}
}


	

?>
