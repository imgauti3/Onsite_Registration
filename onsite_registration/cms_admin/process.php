<?php
include_once('../config.php');

if (isset($_POST['pendingregdelid']) && $_POST['pendingapproveddelete'] == '1') {
    $pendingregdelid = $_POST['pendingregdelid'];
	//delete from registartion
	 $sqry = mysqli_query($connect, "delete from registration where id='$pendingregdelid'");
	//delete from accompan
// 	$sqryacc = mysqli_query($connect, "delete from accperson_registration where reg_id='$pendingregdelid'");
	//delete from masterclass
// 	$sqrymaster = mysqli_query($connect, "delete from masterclass_details where reg_id='$pendingregdelid'");
	//delete from banquet
// 	$sqrybanquet = mysqli_query($connect, "delete from banquet_registration where reg_id='$pendingregdelid'");
	if($sqry)
	{
		echo 'DeletedSucces';
	}
    exit();
}
?>