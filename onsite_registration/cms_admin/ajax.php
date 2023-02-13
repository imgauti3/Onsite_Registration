<?php
include_once('../config.php');
include_once('qrcode/libs/phpqrcode/qrlib.php');
//admin login check
if (isset($_POST['username']) && !empty($_POST['password'])) {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $sqry = mysqli_query($connect, "select * from account_login where username='$username' and password='$password'and status=1 and account_type=0");
    if (mysqli_num_rows($sqry)>0) {
        $results = mysqli_fetch_assoc($sqry);
        @session_start();
        $_SESSION['username'] = $results['username'];
        $_SESSION['userid'] = $results['id'];
        echo '1@@@Login success';
    } else {
        echo '0@@@Please enter valid details.';
    }
    exit();
}

//approved delegate send email
if (isset($_POST['regId']) && !empty($_POST['regId']) && $_POST['sendMail'] == 1) {
    $regid = $_POST['regId'];
    
    $sqry = mysqli_query($connect, "select * from registration where id='$regid' and payment_status=1");
    if (mysqli_num_rows($sqry) > 0) {
        $results = mysqli_fetch_assoc($sqry);
        $fullname = $results['fullname'];
        $email = $results['emailid'];
        $mobile = $results['mobileno'];
        $category = $results['category'];
        // $category = $results['category'];
        // $categorytext = $db->getFieldValue('registration_fee', 'category', 'id', $category);
        // $reg_type = $results['reg_category_type'];
        // $reg_typetext = $db->getFieldValue('reg_type_fee', 'category', 'id', $reg_type);
        $amount = $results['amount'];
        $payment_mode = $results['payment_mode'];
        $transaction_id = $results['transaction_id'];
        $transaction_date = $results['transaction_date'];
        $uid = $results['uid'];

	    $html="<p style='text-align:center;font-size:25px;'><b>Registration Acknowledgement</b></p>
	    <strong>Dear $fullname</strong>, <br>
      <br>Thank you for registering for <span class='il'><b>$event_name</b></span>, scheduled to be held from <b>$event_date</b>.
       <br><br>
      <b>Please find your registration details as mentioned below:</b><br>
      <b>Full Name</b> - $fullname<br>
      <b>Email ID</b> - $email<br>
      <b>Mobile No</b> - $mobile<br>
      <b>Registration ID</b> - $uid<br>
      <b>Category</b> - $category<br>
      <b>Amount</b> - $amount<br>
      <b>Payment Mode</b> - $payment_mode<br>
      <b>Transaction ID</b> - $transaction_id<br>
      <b>Payment Date</b> - $transaction_date<br>
      <b>Payment Status</b> - Success";
$Wahtml="*Dear $fullname*

Thank you for registering for *$event_name*, scheduled to be held at *$event_date*.

*Please find your registration details as mentioned below:*
*Full Name* - $fullname
*Email ID* - $email
*Mobile No* - $mobile
*Registration ID* - $uid
*Category* - $category
*Amount* - $amount
*Payment Mode* - $payment_mode
*Transaction ID* - $transaction_id
*Payment Date* - $transaction_date
*Payment Status* - Success

With Warm Regards
Organizing Team
*$event_name*";
    		    
        $subject="Registration Status @ ".$event_name;
        $db->sendMail($subject,$html, $email, $fullname, $mail_header,$mail_footer, $event_name);
        $db->sendWaSuccess($mobile, $event_name,$Wahtml);
        echo 'Email has been sent to '.$email;
    } else {
        echo 'Something went wrong. Please try again';
    }
}

//approved abstract send email
if (isset($_POST['absId']) && !empty($_POST['absId']) && $_POST['sendAbsMail'] == 1) {
    $regid = $_POST['absId'];
    
    $sqry = mysqli_query($connect, "select * from abstract_submission where id='$regid'");
    if (mysqli_num_rows($sqry) > 0) {
        // $results = mysqli_fetch_assoc($sqry);
         $resluts = mysqli_fetch_assoc($sqry);
        $fullname = $resluts['presenter_name'];
        $absid = $resluts['abstract_no'];
        $email = $resluts['registered_emailid'];
        $mobileno = $resluts['mobile_no'];
        $regid = $resluts['registration_id'];
        $abs_category = $resluts['abs_category'];
        $title = $resluts['title'];
        $status = $resluts['status'];
        $approved_for = $resluts['approved_for'];
        $html="<strong>Dear $fullname</strong>, 
               <br><br>
              <b>Please find your Abstract details as mentioned below:</b><br>
              <b>Abstract No</b> - $absid<br>
              <b>Presenter Name</b> - $fullname<br>
              <b>Email ID</b> - $email<br>
              <b>Mobile No</b> - $mobileno<br>
              <b>Title</b> - $title<br>";
              if ($status == 'Approve') {
              $html.="<b>Approved For</b> - $approved_for<br>
              <b>Status</b> - $status<br>";
              } else {
                $html.="<b>Status</b> - $status";
              }
            //   if ($approved_for == 'Oral Presentation') {
            //   $html.="<b>The scientific committee of LASACON 2022 has reviewed your abstract and has accepted your abstract for presentation in LASACON 2022.<br>However,  you are requested to register for the conference and we will communicate on whether you can present it as an oral or a poster presentation after 20th May 2022.</b>";
            //   } else {
            //     $html.="";
            //   }
                                                
            $subject="Abstract @ ".$event_name;
            $db->sendMail($subject,$html, $email, $applicant_name, $mail_header,$mail_footer1, $event_name);
            echo 'Email has been sent to '.$email;
    } else {
        echo 'Something went wrong. Please try again';
    }
}


//approved delegate send email
if (isset($_POST['regId']) && !empty($_POST['regId']) && $_POST['sendMail_del'] == 1) {
    $regid = $_POST['regId'];
    
    $sqry = mysqli_query($connect, "select * from delegate_list where id='$regid'");
    if (mysqli_num_rows($sqry) > 0) {
        $results = mysqli_fetch_assoc($sqry);
        $unique_id = $results['unique_id'];
        $fullname = $results['fullname'];
        $email = $results['emailid'];
        $mobile = $results['mobileno'];
        $category = $results['reg_category'];
      
      
      $tempDir2 = 'qrcode/agreement-pdf/qrimages/'; 
	$qrimage2 = md5(rand(12545,99999)).str_replace(' ', '_', $unique_id);
	$codeContents2 = $unique_id; 
// 	$codeContents2 = "Your Registration ID:".$uid; 
	QRcode::png($codeContents2, $tempDir2.''.$qrimage2.'.png', QR_ECLEVEL_L, 5);
	$qrimagepath2=$base_url."qrcode/agreement-pdf/qrimages/".$qrimage2.".png";
	
	
	
	    $html="<p style='text-align:center;font-size:25px;'><b>Registration Acknowledgement</b></p>
	    <strong>Dear $fullname</strong>, <br>
      <br>Thank you for registering for <span class='il'><b>$event_name</b></span>, scheduled to be held from <b>$event_date</b>.
       <br><br>
      <b>Please find your registration details as mentioned below:</b><br>
       <b> <img src='$qrimagepath2'><br>
      <b>Full Name</b> - $fullname<br>
      <b>Email ID</b> - $email<br>
      <b>Mobile No</b> - $mobile<br>
      <b>Category</b> - $category<br>";

        $subject="Registration Status @ ".$event_name;
        $db->sendMail($subject,$html, $email, $fullname, $mail_header,$mail_footer, $event_name);
        echo 'Email has been sent to '.$email;
    } else {
        echo 'Something went wrong. Please try again';
    }
}

?>