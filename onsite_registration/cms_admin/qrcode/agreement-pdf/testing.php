<?php
ob_start();
error_reporting(E_ALL | E_STRICT);
//require_once('config/config.php');
require_once("dompdf/dompdf_config.inc.php");


?>
<!--
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Print Ticket</title>-->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
<style type="text/css">
body {
	width:100%;
	max-width:530px;
	margin:0 auto;
	padding:30px;
}
*, body {
	font-family: 'Roboto', sans-serif;
	font-size:13px;
	color:#23364d;
	line-height:18px;
}
table {
	width:100%;
}
h1, h2, h3, h4, h5, h6 {
	color:#000;
	font-weight:600;
	margin-top:0px;
	margin-bottom:5px;
}
ul li {
	margin-bottom:5px;
}
a {
	color:blue;
}
p {
	margin:0;
}
@media print {
body {-webkit-print-color-adjust: exact;}
}
</style>
<!--</head>
<body>-->
<div style="width:100%;">
      <div style="width:25%;display:inline-block;">
            <div width="130px"><img src="images/lic-logo.png" style="width:140px;"/></div>
        </div>
      <div style="width:75%;text-align:right;display:inline-block;float:right;">
          <p style="font-weight:500;line-height:22px;margin-bottom:02px;">For your LIC policy enquiries (24*7), call on 022-68276827 <span style="display:block;">SMS: LICHELP "Policy Number" to 9222492224</span></p>
        <p style="margin-bottom:05px;">Email: pcmc.cbk1@licindia.com</p>
        <span style="color: #909090;font-size: 15px;font-weight: 400;display: inline-block;">GST No.37AAACL0582H2ZK</span> </div>
</div>
<div  style="background:#f4f4f4;margin-top:20px;width:100%;">
  
      <div style="width:50%;padding:10px 15px;"><h4 style="font-size:16px;font-weight:500;">Renewal Premium Receipt</h4>
     </div>
</div>
<div style="font-size:15px;margin-top:10px;" >
 
      <div style="border:3px solid #f4f4f4;padding:6px 10px;font-weight:500;border-bottom:0px;">
       
          <div style="display:inline-block;width:65%;display:inline-block;">Reference ID</div>
          <div style="text-align:right;display:inline-block;width:35%;display:inline-block;float:right;"><?php echo $trnsaction_id; ?></div>
        
      </div>
    
    
      <div style="border:3px solid #f4f4f4;padding:6px 10px;font-weight:500;border-bottom:0px; ">
        
          <div style="display:inline-block;width:65%;display:inline-block;">Payment Date</div>
          <div style="text-align:right;display:inline-block;width:35%;display:inline-block;float:right;"><?php echo $transaction_start_time; ?></div>
        
      </div>
    
  
    
      <div style="border:3px solid #f4f4f4;border-bottom:0px;padding:6px 10px;font-weight:500;">
        
          <div style="display:inline-block;width:65%;display:inline-block;"> Name</div>
          <div style="text-align:right;display:inline-block;width:35%;display:inline-block;float:right;"><?php echo $customer_name; ?></div>
        
      </div>
    
	  
      <div style="border:3px solid #f4f4f4;border-bottom:0px;padding:6px 10px;font-weight:500;">
        
          <div style="display:inline-block;width:65%;display:inline-block;">Conatct No</div>
          <div style="text-align:right;display:inline-block;width:35%;display:inline-block;float:right;"><?php echo $customer_mobile; ?></div>
        
      </div>
    
    
      <div style="border:3px solid #f4f4f4;border-bottom:0px;padding:6px 10px;font-weight:500;">
        
          <div style="display:inline-block;width:65%;display:inline-block;">Policy Number</div>
          <div style="text-align:right;display:inline-block;width:35%;display:inline-block;float:right;"><?php echo $policy_no; ?></div>
        
      </div>
    
   
      <div style="border:3px solid #f4f4f4;border-bottom:0px;padding:6px 10px;font-weight:500;">
        
          <div style="display:inline-block;width:65%;display:inline-block;">Due From</div>
          <div style="text-align:right;display:inline-block;width:35%;display:inline-block;float:right;"><?php echo $due_from; ?> </div>
        
      </div>
    
      <div style="border:3px solid #f4f4f4;border-bottom:0px;padding:6px 10px;font-weight:500;">
        
          <div style="display:inline-block;width:65%;">Due To</div>
          <div style="text-align:right;display:inline-block;width:35%;float:right;"><?php echo $due_to; ?> </div>
        
      </div>
    
	
      <div style="border:3px solid #f4f4f4;border-bottom:0px;padding:6px 10px;font-weight:500;">
        
          <div style="display:inline-block;width:65%;">Number of Installments</div>
          <div style="text-align:right;display:inline-block;width:35%;float:right;"><?php echo $no_of_instlallment; ?> </div>
        
      </div>
    
	 
      <div style="border:3px solid #f4f4f4;border-bottom:0px;padding:6px 10px;font-weight:500;">
        
          <div style="display:inline-block;width:65%;">Installment Premium</div>
          <div style="text-align:right;display:inline-block;width:35%;float:right;">&#8377;<?php echo $total_premium; ?> </div>
        
      </div>
    
  
      <div style="border:3px solid #f4f4f4;border-bottom:0px;padding:6px 10px;font-weight:500;">
        
          <div style="display:inline-block;width:65%;">CDA Charges</div>
          <div style="text-align:right;display:inline-block;width:35%;float:right;">&#8377;0.00 </div>
        
      </div>
    
	
      <div style="border:3px solid #f4f4f4;border-bottom:0px;padding:6px 10px;font-weight:500;">
        
          <div style="display:inline-block;width:65%;">X-Charge</div>
          <div style="text-align:right;display:inline-block;width:35%;float:right;">&#8377;0.00 </div>
        
      </div>
    
	
      <div style="border:3px solid #f4f4f4;border-bottom:0px;padding:6px 10px;font-weight:500;">
        
          <div style="display:inline-block;width:65%;">State Cess</div>
          <div style="text-align:right;display:inline-block;width:35%;float:right;">&#8377;0.00 </div>
        
      </div>
    
	
      <div style="border:3px solid #f4f4f4;border-bottom:0px;padding:6px 10px;font-weight:600; ">
        
          <div style="display:inline-block;width:65%;">Grand Total</div>
          <div style="text-align:right;display:inline-block;width:35%;float:right;">&#8377;<?php echo $total_premium; ?> </div>
        
      </div>
    
	
      <div style="border:3px solid #f4f4f4;border-bottom:0px;padding:6px 10px;font-weight:500; ">
        
          <div style="display:inline-block;width:65%;">GST borne by LIC of India </div>
          <div style="text-align:right;display:inline-block;width:35%;float:right;">&#8377;0.00 </div>
        
      </div>
    
	
      <div style="border:3px solid #f4f4f4;padding:6px 10px;font-weight:500; ">
        
          <div style="display:inline-block;width:65%;">State cess borne by LIC of India</div>
          <div style="text-align:right;display:inline-block;width:35%;float:right;">&#8377;0.00 </div>
        
      </div>
    
  

</div>
<div style="margin-top:20px;float:left;">

    
      <div style="width:10%;    display:inline-block;
    align-items: center;"><h5>NOTE:</h5></div>
      <div style="width:90%;display:inline-block;float:right;"><p style="text-align:justify;">In case of any concerns, please quote Quick2Recharge Order ID, Order Date, Receipt Number and Policy Number.
          Please note that this receipt is the only acknowledgement of this transaction. LIC will not send any separate acknowledgement or
          receipt.This is a computer generated receipt and does not require physical signature</p></div>
    

</div>
<div style="margin-top:10px;float:left;width:100%;">

    
      <div style="width:70%;display:inline-block;"><p>Cloud Techno Solutions (Quick2Recharge.in), Guntur,<span style="display:block;"></span>Andhra Pradesh- 522002.<span style="display:block;margin-top:3px;"></span> GST No. : 37AAJFC5512A1ZX</p></div>
      <div  style="width:30%;display:inline-block;float:right;"><img src="https://quick2recharge.in/admin/assets/img/logo-dark.png" style="width:150px;"> </div>
    

</div>

<!--
</body>
</html>-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<?php
echo $html = ob_get_clean();
 $filename=md5(rand()).'.pdf';
$dompdf = new Dompdf();
$dompdf->load_html($html);
$dompdf->render();
$file=$dompdf->output();
file_put_contents($filename,$file);
$uploadpath="./";
$file=$uploadpath.$filename;


/* file download */
/*header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename='.$filename);
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filename));
readfile($filename);
unlink($file_url);
exit;*/
?>