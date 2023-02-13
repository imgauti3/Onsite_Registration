<?php
include_once('../config.php');
include_once('qrcode/libs/phpqrcode/qrlib.php');

//approved delegate send email
if (isset($_POST['regId']) && !empty($_POST['regId']) && $_POST['sendMail_del'] == 1) {
    $regid = $_POST['regId'];
    //echo $regid;exit;
    $sqry = mysqli_query($connect, "select * from delegate_list where id='$regid'");
    if (mysqli_num_rows($sqry) > 0) {
        $results = mysqli_fetch_assoc($sqry);
        $unique_id = $results['unique_id'];
        $fullname = $results['fullname'];
        $email = $results['emailid'];
        $mobile = $results['mobileno'];
        $category = $results['reg_category'];
        $place = $results['place'];
      
      
      $tempDir2 = 'qrcode/agreement-pdf/qrimages/'; 
	$qrimage2 = md5(rand(12545,99999)).str_replace(' ', '_', $unique_id);
	$codeContents2 = $unique_id; 
// 	$codeContents2 = "Your Registration ID:".$uid; 
	QRcode::png($codeContents2, $tempDir2.''.$qrimage2.'.png', QR_ECLEVEL_L, 5);
	$qrimagepath2=$base_url."cms_admin/qrcode/agreement-pdf/qrimages/".$qrimage2.".png";
	
	$html="<img src='$qrimagepath2'><p><b style='text-align:center;font-size:25px;'>$fullname</b><br>$place</p>";
	
	   // $html="<p style='text-align:center;font-size:25px;'><b>Registration Acknowledgement</b></p>
	   // <strong>Dear $fullname</strong>, <br>
    //   <br>Thank you for registering for <span class='il'><b>$event_name</b></span>, scheduled to be held from <b>$event_date</b>.
    //   <br><br>
    //   <b>Please find your registration details as mentioned below:</b><br>
    //   <b> <img src='$qrimagepath2'><br>
    //   <b>Registration ID</b> - $unique_id<br>
    //   <b>Full Name</b> - $fullname<br>
    //   <b>Email ID</b> - $email<br>
    //   <b>Mobile No</b> - $mobile<br>
    //   <b>Category</b> - $category<br>";

        $subject="eBadge @ ".$event_name;
        $db->sendMail($subject,$html, $email, $fullname, $mail_header1,$mail_footer2, $event_name);
        // $db->sendMail($subject,$html, $email, $fullname, $mail_header,$mail_footer, $event_name);
        echo 'Email has been sent to '.$email;
    } else {
        echo 'Something went wrong. Please try again';
    }
}

?>