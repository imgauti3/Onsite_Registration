<?php

require "../barcode/vendor/autoload.php";
$Bar = new Picqer\Barcode\BarcodeGeneratorPNG();
$path="../db.php";
include_once($path);


$db = new DB();
$uid=$_POST['uid'];
$conditions=array("where"=>array('unique_id'=>$uid));
$record=$db->getRows('delegate_list',$conditions);

$phone=$record[0]['mobileno'];
$fullName=$record[0]['fullname'];
$email=$record[0]['emailid'];

    if($_POST['img_type']=='qr')
    {
        // echo '<img src="'.$base_url.'qrcode/generate_QR.php?uid='.$uid.'" width="23%" height="23%"/>';
    }
    
    if($_POST['img_type']=='barcode')
    {
        echo "<img width='35%' src='data:image/png;base64," . base64_encode($Bar->getBarcode($uid, $Bar::TYPE_CODE_128_A)) . "'>";
    }
  
    if($_POST['img_type']=='Both')
    {
        // echo '<img src="'.$base_url.'qrcode/generate_QR.php?uid='.$uid.'" width="23%" height="23%" style="display: block; margin-left: auto; margin-right: auto; width: 25%;"/>';
    }

    echo "<h3 class='' style='font-size:30px !important;color:#000; text-align: center;'><b>".wordwrap(ucWords(strtoupper($record[0]['fullname'])), 30, "<br >",false)."</b></h3>";

    echo "<p class='' style='font-size:20px !important;color:#000; text-align: center;'>".$record[0]['place']."</p>";

    if($_POST['img_type']=='Both')
    {
        echo "<img src='data:image/png;base64," . base64_encode($Bar->getBarcode($uid, $Bar::TYPE_CODE_128_A)) . "' width='35%' height='35%' style='display: block; margin-left: auto; margin-right: auto; width: 50%;'>
        <h6 style='color:#000;font-size:20px !important; text-align: center;'>".$record[0]['unique_id']."</h6>";
    }
?>
