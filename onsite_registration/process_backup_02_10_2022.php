<?php
session_start();
include_once('db.php');

$db = new DB();

if(isset($_POST["getData"]) && $_POST["getData"] == 1)
{
    $sqry = mysqli_query($connect, "SELECT * FROM `delegate_list` where 1=1");
    $data['totalDel'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `delegate_list` where badge_printed='Yes'");
    $data['badgePrinted'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `delegate_list` where kit_delivered_date!=''");
    $data['kitbagDelivered'] = mysqli_num_rows($sqry);
    
    $sqry = mysqli_query($connect, "SELECT * FROM `delegate_list` where certificate_printed_date!=''");
    $data['certificateIssued'] = mysqli_num_rows($sqry);
    
    
    echo json_encode($data);
    exit();
}

$date=$dateTime;

if(isset($_POST["searchKey"]) && $_POST["search"] == 1)
{
  $qry="SELECT * FROM `delegate_list` where concat(unique_id,' ',fullname,' ',reg_category,'  ',mobileno,' ',emailid,' ',place) like '%".$_POST["searchKey"]."%'";
   $r=mysqli_query($connect,$qry);
    if(mysqli_num_rows($r))
    {
        while($row=mysqli_fetch_assoc($r))
        {
            $jsondata = json_encode($row);
            $fullname = $row['fullname'];
            $emailid = $row['emailid'];
            $mobileno = $row['mobileno'];
            $reg_category = $row['reg_category'];
            $id = $row['id'];
            $kitbag = $row['kit'];
            $place = $row['place'];
            $reference_note = $row['reference_note'];
            if($row["badge_printed"]=='Yes')
            {
            	$tx="Printed";
                $cls ="btn-danger";
                $dis="print";
            }
            else
            {
            	$tx="Print";
                $dis="print";
                $cls = "btn-success";
            }
        $s_id=$row["unique_id"];
        
         $data="<tr>
         <td><input class='form-control' type='checkbox' name='printed' id='printed'></td>
        <td><a data-id='".$s_id."' class='btn $cls $dis'>$tx</a>";
            $data.="<a class='btn bg-success-light edit-record'  data-rec='$jsondata' data-toggle='modal' href='#badge_edit'><i class='fe fe-pencil'></i> Edit</td>'";
            $data.="<td>".$row["unique_id"]."</td>
            <td>".$row["reg_category"]."</td>
            <td>".$row["fullname"]."</td>
            <td>".$row["reference_note"]."</td>
            <td>".$row["mobileno"]."</td>
            </tr>";
            echo $data;
        }
    }
    else{
        echo "<span style='font-size: 18px;'>No Results Found</span>";
    }
}

//Certificate search

if(isset($_POST["searchKey"]) && $_POST["certsearch"] == 1)
{
  $qry="SELECT * FROM `delegate_list` where concat(unique_id,' ',fullname,' ',reg_category,'  ',mobileno,' ',emailid,' ',place) like '%".$_POST["searchKey"]."%'";
   $r=mysqli_query($connect,$qry);
    if(mysqli_num_rows($r))
    {
        while($row=mysqli_fetch_assoc($r))
        {
            
            if($row["certificate_printed_date"]!='')
            {
            	$tx="Already Printed At ".$row["certificate_printed_date"];
                $cls ="btn-danger";
                $dis="print";
            } else if ($row["certificate_printed"] == 0) {
                $cls ="btn-danger";
                $dis="disabled";
                $tx="Not Allowed";
            }
            else
            {
            	$tx="Print";
                $dis="print";
                $cls = "btn-success";
            }
        $s_id=$row["unique_id"];
        $name1 = $row["certificate_name"];
        $place = $row["place"];
        // $name = $row["certificate_name"] $row["place"];
        // $name = $name1.", ".$place;
        $name = $name1;
        
         $data="<tr>
        <td><a data-id='".$s_id."' data-name='".$name."' class='btn $cls $dis'>$tx</a>";
            
            $data.="<td>".$row["unique_id"]."</td>
            <td>".$row["reg_category"]."</td>
            <td>".$row["certificate_name"]."</td>
            <td>".$row["emailid"]."</td>
            <td>".$row["mobileno"]."</td>
            </tr>";
            echo $data;
        }
    }
    else{
        echo "<span style='font-size: 18px;'>No Results Found</span>";
    }
}



//Workshop : Scanner
if(isset($_POST["Wscanner"]))
{
	$data['norec']=true;
  $qry="SELECT * FROM `registered_list` where uid!='Pending Registration' and  uid='".$_POST["d"]."' ";
   $r=mysqli_query($conn,$qry);
    if(mysqli_num_rows($r))
    {
		$data['norec']=false;
			$row=mysqli_fetch_assoc($r);
            if($row[$_POST['wcol']]=='Entered')
            {
      				$data['status']=true;
      				$data['stat_txt']='Access Denied! Already Scanned ';
            }
      			elseif($row[$_POST['wcol']]=='Allow')
      			{
              $result=mysqli_query($conn,"update registered_list set ".$_POST['wcol']."='Entered' where uid='".$_POST["d"]."' ");
              $data['status']=false;
      			}
            elseif($row[$_POST['wcol']]=='')
            {
              $data['stat_txt']='Not Allowed for this Workshop';
      				$data['status']=true;
            }
				        $data['html']="<tr>
						<td>".$row["uid"]."</td>
						<td>".$row["name"]."</td>
						<td>".$row["category"]."</td>
						<td>".$row["city"]."</td>
						<td>".$row["mobile"]."</td>
						<td>".$row["email"]."</td>
						</tr>";

    }
    else{
        $data['html'] ="<span style='font-size: 18px;'>No Results Found</span>";
    }
	 echo json_encode($data);
}
//Workshop : Manual
if(isset($_POST["workshop"]))
{
  $data['html']='';
  $qry="SELECT * FROM `registered_list` where uid!='Pending Registration' and concat(uid,' ',name,' ',category,' ',city,' ',mobile,' ',email) like '%".$_POST["d"]."%'";
   $r=mysqli_query($conn,$qry);
    if(mysqli_num_rows($r))
    {
        while($row=mysqli_fetch_assoc($r))
        {           if($row[$_POST['wcol']]=='Entered')
                    {
                        $btn ="printed";
                        $disabled="disabled";
                        $txt="Entered";
                    }
                    elseif($row[$_POST['wcol']]=='Allow')
                    {
                        $disabled="";
                        $btn = "btn-success";
                        $txt="Allow";
                    }
                    else{
                      $btn ="printed";
                      $disabled="disabled";
                      $txt="Not Allowed";
                    }

            $data['html'] .="<tr>
            <td><a data-id='".base64_encode($row["uid"])."' class='btn $btn deliver' $disabled>$txt</a></td>
            <td>".$row["uid"]."</td>
            <td>".$row["name"]."</td>
            <td>".$row["mobile"]."</td>
            <td>".$row["email"]."</td>
            <td>".$row["city"]."</td>
            </tr>";
        }
    }
    else{
        $data['html']="<span style='font-size: 18px;'>No Results Found</span>";
    }
    echo json_encode($data);
}


//Kitbag : Scanner
if(isset($_POST["kitbagAuto"]))
{
    $data['html']='';
  $qry="SELECT * FROM `delegate_list` where unique_id ='".$_POST["kitbagKey"]."'";
   $r=mysqli_query($connect,$qry);
    if(mysqli_num_rows($r))
    {
        while($row=mysqli_fetch_assoc($r))
        {
            if($row["kit_delivered_date"]!='')
            {
                $btn ="btn-warning";
                $disabled="disabled";
                $txt="Already Delivered At ".$row["kit_delivered_date"];
                $data['error'] = "Already Delivered At ".$row["kit_delivered_date"];
            }
            elseif($row["kit"]=='0')
            {
                $btn ="btn-danger";
                $disabled="disabled";
                $txt="Not Allowed";
                $data['error'] = "Not Allowed";
            }
            else
            {
  			    $result=mysqli_query($connect,"update delegate_list set kit_delivered_date='$date' where unique_id='".$_POST["kitbagKey"]."' ");
  			    $data['status']=false;
                $disabled="disabled";
                $btn = "btn-success";
                $txt="Delivered Now";
                $data['success'] = "Successfully Delivered";
            }
        $s_id=$row["unique_id"];
        $data['html'] .="<tr>
            <td><a data-id='".$s_id."' class='btn $btn' $disabled>$txt</a></td>
            <td>".$row["unique_id"]."</td>
            <td>".$row["fullname"]."</td>
            <td>".$row["reg_category"]."</td>
            <td>".$row["place"]."</td>
            <td>".$row["mobileno"]."</td>
            <td>".$row["emailid"]."</td>
            </tr>";
        }
    }
    else{
        $data['html'] .="<span style='font-size: 18px;'>No Results Found</span>";
    }
    echo json_encode($data);
}
//kitbag : Manual
if(isset($_POST["kitbagM"]))
{
  $data['html']='';
  $qry="SELECT * FROM `delegate_list` where concat(unique_id,' ',fullname,' ',reg_category,' ',place,' ',mobileno,' ',emailid) like '%".$_POST["kitbagKey"]."%'";
   $r=mysqli_query($connect,$qry);
    if(mysqli_num_rows($r))
    {
        while($row=mysqli_fetch_assoc($r))
        {
            if($row["kit_delivered_date"]!='')
            {
                $btn ="btn-warning";
                $disabled="disabled";
                $txt="Already Delivered At ".$row["kit_delivered_date"];
                $data['error'] = false;
            }
            elseif($row["kit"]=='0')
            {
                $btn ="btn-danger";
                $disabled="disabled";
                $txt="Not Allowed";
                $data['error'] = false;
            }
            else
            {
                $disabled="";
                $btn = "btn-success deliver";
                $txt="Deliver";
                $data['success'] = false;
            }
        $s_id=$row["unique_id"];
        $data['html'] .="<tr>
            <td><a data-id='".$s_id."' class='btn $btn' $disabled>$txt</a></td>
            <td>".$row["unique_id"]."</td>
            <td>".$row["fullname"]."</td>
            <td>".$row["reg_category"]."</td>
            <td>".$row["place"]."</td>
            <td>".$row["mobileno"]."</td>
            <td>".$row["emailid"]."</td>
            </tr>";
        }
    }
    else{
        $data['html'] .="<span style='font-size: 18px;'>No Results Found</span>";
    }
    echo json_encode($data);
}


//Certificate : Manual
if(isset($_POST["certificateM"]))
{
  $data['html']='';
  $qry="SELECT * FROM `delegate_list` where concat(unique_id,' ',fullname,' ',reg_category,' ',place,' ',mobileno,' ',emailid) like '%".$_POST["certificateKey"]."%'";
   $r=mysqli_query($connect,$qry);
    if(mysqli_num_rows($r))
    {
        while($row=mysqli_fetch_assoc($r))
        {
            if($row["certificate_printed_date"]!='')
            {
                $btn ="btn-info";
                $disabled="disabled";
                $txt="Delivered";
                $data['error'] = "Already Delivered";
            }
            elseif($row["certificate_printed"]=='0')
            {
                $btn ="btn-danger";
                $disabled="disabled";
                $txt="Not Allowed";
                $data['error'] = "Not Allowed";
            }
            else
            {
            
  						//$result=mysqli_query($conn,"update registered_list set kit_delivered_date='$date' where unique_id='".$_POST["d"]."' ");
  						//$data['status']=false;
            
                
                $disabled="";
                $btn = "btn-success deliver";
                $txt="Deliver";
            }
        $s_id=$row["unique_id"];
        $data['html'] .="<tr>
            <td><a data-id='".$s_id."' class='btn $btn' $disabled>$txt</a></td>
            <td>".$row["unique_id"]."</td>
            <td>".$row["certificate_name"]."</td>
            <td>".$row["reg_category"]."</td>
            <td>".$row["place"]."</td>
            <td>".$row["mobileno"]."</td>
            <td>".$row["emailid"]."</td>
            </tr>";
        }
    }
    else{
        $data['html'] .="<span style='font-size: 18px;'>No Results Found</span>";
    }
    echo json_encode($data);
}


//Food : Scanner
if(isset($_POST["foodAuto"]))
{
	$foodtoken = $_POST["foodtoken"];
	$data['html']='';
  $qry="SELECT * FROM `delegate_list` where unique_id ='".$_POST["foodKey"]."'";
   $r=mysqli_query($connect,$qry);
    if(mysqli_num_rows($r))
    {
        while($row=mysqli_fetch_assoc($r))
        {
           
            if($row[$foodtoken])
            {
                $btn ="btn-warning";
                $disabled="disabled";
                $txt="Already Checked-In";
                $data['error'] = "Already Checked-In";
            }
            else if ($row[$foodtoken] == '0'){
                 $btn ="btn-danger";
                $disabled="disabled";
                $txt="Not Allowed";
                $data['error'] = "Not Allowed";
            } else {
                $result=mysqli_query($connect,"update delegate_list set ".$foodtoken."=1 where unique_id='".$_POST["foodKey"]."'");
                $disabled="";
                $btn = "btn-success deliver";
                $txt="Check In Now";
                $data['success'] = "Checked-In Now";
            }
            
        $s_id=$row["unique_id"];
        $data['html'] .="<tr>
            <td><a data-id='".$s_id."' class='btn $btn' $disabled>$txt</a></td>
            <td>".$row["unique_id"]."</td>
            <td>".$row["fullname"]."</td>
            <td>".$row["reg_category"]."</td>
            <td>".$row["place"]."</td>
            <td>".$row["mobileno"]."</td>
            <td>".$row["emailid"]."</td>
            </tr>";
        }
    }
    else{
        $data['html'] .="<span style='font-size: 18px;'>No Results Found</span>";
    }
    echo json_encode($data);
}

//Food : Manual
if(isset($_POST["foodM"]))
{
    $foodtoken = $_POST["foodtoken"];
	$data['html']='';
  $qry="SELECT * FROM `delegate_list` where concat(unique_id,' ',fullname,' ',reg_category,' ',place,' ',mobileno,' ',emailid) like '%".$_POST["foodKey"]."%'";
   $r=mysqli_query($connect,$qry);
    if(mysqli_num_rows($r))
    {
        while($row=mysqli_fetch_assoc($r))
        {
           
            if($row[$foodtoken])
            {
                $btn ="btn-warning";
                $disabled="disabled";
                $txt="Already Cheked-In";
                $data['error'] = false;
            }
            else if ($row[$foodtoken] == '')
            {
                $disabled="";
                $btn = "btn-success deliver";
                $txt="Check-In Now";
                $data['success'] = false;
            } else {
                 $btn ="btn-danger";
                $disabled="disabled";
                $txt="Not Allowed";
                $data['error'] = false;
            }
            
        $s_id=$row["unique_id"];
        $data['html'] .="<tr>
            <td><a data-id='".$s_id."' class='btn $btn' $disabled>$txt</a></td>
            <td>".$row["unique_id"]."</td>
            <td>".$row["fullname"]."</td>
            <td>".$row["reg_category"]."</td>
            <td>".$row["place"]."</td>
            <td>".$row["mobileno"]."</td>
            <td>".$row["emailid"]."</td>
            </tr>";
        }
    }
    else{
        $data['html'] .="<span style='font-size: 18px;'>No Results Found</span>";
    }
    echo json_encode($data);
}



//Badge

if(isset($_POST["print"]))
{
    //$date=$dateTime;
     $qry="update `delegate_list` set badge_printed_on='$date',badge_printed='Yes' where unique_id='".$_POST["uid"]."'";
     $r=mysqli_query($connect,$qry);
    if($r)
    {
        $status=true;
    }
    echo $status;
}

//Certificate

if(isset($_POST["certprint"]))
{
    //$date=$dateTime;
     $qry="update `delegate_list` set certificate_printed_date='$date' where unique_id='".$_POST["uid"]."'";
     $r=mysqli_query($connect,$qry);
    if($r)
    {
        $status=true;
    }
    echo $status;
}
//Certificate:Deliver btn
if(isset($_POST["certificateDeliver"]))
{
    //$date=date("d-m-Y h:i:sa");
     $qry="update `delegate_list` set certificate_printed_date='$date' where unique_id='".$_POST["uid"]."'";
     $r=mysqli_query($connect,$qry);
    if($r)
    {
        $status=true;
    }
    echo json_encode($status);
}

//Kitbag:Deliver btn
if(isset($_POST["kitDeliver"]))
{
    $data['status'] = false;
    //$date=date("d-m-Y h:i:sa");
     $qry="update `delegate_list` set kit_delivered_date='$date' where unique_id='".$_POST["uid"]."'";
     $r=mysqli_query($connect,$qry);
    if($r)
    {
        $status=true;
        $data['status'] = true;
        $data['success'] = "Successfully Delivered";
    }

    echo json_encode($data);

}



//Bagde:Deliver btn
if(isset($_POST["Bagdedeliver"]))
{

    $date=date("d-m-Y h:i:sa");
     $qry="update `registered_list` set badge_date='$date',badge='Delivered' where uid='".base64_decode($_POST["uid"])."'";
     $r=mysqli_query($conn,$qry);
    if($r)
    {
        $status=true;
    }

    echo json_encode($status);

}


//badge : Scanner
if(isset($_POST["Badgescanner"]))
{
	$date=date("d-m-Y h:i:sa");
	$data['norec']=true;
  $qry="SELECT * FROM `registered_list` where uid!='Pending Registration' and  uid='".$_POST["d"]."' ";
   $r=mysqli_query($conn,$qry);
    if(mysqli_num_rows($r))
    {
		$data['norec']=false;
			$row=mysqli_fetch_assoc($r);
            if($row['badge']=='Delivered')
            {
      				$data['status']=true;
      				$data['stat_txt']='Access Denied! Already Delivered ';
            }
      			elseif($row['badge']=='Not Allowed')
      			{
      				$data['stat_txt']='Not Allowed to issue a badge';
      				$data['status']=true;
      			}
            else
            {
  						$result=mysqli_query($conn,"update registered_list set badge_date='$date',badge='Delivered' where uid='".$_POST["d"]."' ");
  						$data['status']=false;
            }
				    $data['html']="<tr>
						<td>".$row["uid"]."</td>
						<td>".$row["name"]."</td>
						<td>".$row["category"]."</td>
						<td>".$row["city"]."</td>
						<td>".$row["mobile"]."</td>
						<td>".$row["email"]."</td>
            <td>".$row["note"]."</td>
						</tr>";

    }
    else{
        $data['html'] ="<span style='font-size: 18px;'>No Results Found</span>";
    }
	 echo json_encode($data);
}



//badge : Manual
if(isset($_POST["badge"]))
{
    
    
	    
  $data['html']='';
  $qry="SELECT * FROM `registered_list` where uid!='Pending Registration' and concat(uid,' ',name,' ',category,' ',city,' ',mobile,' ',email) like '%".$_POST["d"]."%'";
   $r=mysqli_query($conn,$qry);
    if(mysqli_num_rows($r))
    {
        while($row=mysqli_fetch_assoc($r))
        {
            if($row["badge"]=='Delivered')
            {
                $btn ="printed";
                $disabled="disabled";
                $txt="Delivered";
            }
            elseif($row["badge"]=='Not Allowed')
            {
                $btn ="printed";
                $disabled="disabled";
                $txt="Not Allowed";
            }
            else
            {
            
  						$result=mysqli_query($conn,"update registered_list set badge_date='$date',badge='Delivered' where uid='".$_POST["d"]."' ");
  						$data['status']=false;
            
                
                $disabled="";
                $btn = "btn-success";
                $txt="Deliver";
            }
        $s_id=base64_encode($row["id"]);
        $data['html'] .="<tr>
            <td><a data-id='".base64_encode($row["uid"])."' class='btn $btn deliver' $disabled>$txt</a></td>
            <td>".$row["uid"]."</td>
            <td>".$row["name"]."</td>
            <td>".$row["category"]."</td>
            <td>".$row["city"]."</td>
            <td>".$row["mobile"]."</td>
            <td>".$row["email"]."</td>
            </tr>";
        }
    }
    else{
        $data['html'] .="<span style='font-size: 18px;'>No Results Found</span>";
    }
    echo json_encode($data);
}


//headcount:Deliver btn
if(isset($_POST["headcountdeliver"]))
{

    $date=date("d-m-Y h:i:sa");
     $qry="update `registered_list` set headcount_date='$date',headcount='Delivered' where uid='".base64_decode($_POST["uid"])."'";
     $r=mysqli_query($conn,$qry);
    if($r)
    {
        $status=true;
    }

    echo json_encode($status);

}


//headcount : Scanner
if(isset($_POST["Headcountscanner"]))
{
	$date=date("d-m-Y h:i:sa");
	$data['norec']=true;
  $qry="SELECT * FROM `registered_list` where uid!='Pending Registration' and  uid='".$_POST["d"]."' ";
   $r=mysqli_query($conn,$qry);
    if(mysqli_num_rows($r))
    {
		$data['norec']=false;
			$row=mysqli_fetch_assoc($r);
            if($row['headcount']=='Delivered')
            {
      				$data['status']=true;
      				$data['stat_txt']='Access Denied! Already Delivered ';
            }
      			elseif($row['headcount']=='Not Allowed')
      			{
      				$data['stat_txt']='Not Allowed to issue a badge';
      				$data['status']=true;
      			}
            else
            {
  						$result=mysqli_query($conn,"update registered_list set headcount_date='$date',headcount='Delivered' where uid='".$_POST["d"]."' ");
  						$data['status']=false;
            }
				    $data['html']="<tr>
						<td>".$row["uid"]."</td>
						<td>".$row["name"]."</td>
						<td>".$row["category"]."</td>
						<td>".$row["city"]."</td>
						<td>".$row["mobile"]."</td>
						<td>".$row["email"]."</td>
            <td>".$row["note"]."</td>
						</tr>";

    }
    else{
        $data['html'] ="<span style='font-size: 18px;'>No Results Found</span>";
    }
	 echo json_encode($data);
}


//headcount : Manual
if(isset($_POST["headcount"]))
{
    
    
	    
  $data['html']='';
  $qry="SELECT * FROM `registered_list` where uid!='Pending Registration' and concat(uid,' ',name,' ',category,' ',city,' ',mobile,' ',email) like '%".$_POST["d"]."%'";
   $r=mysqli_query($conn,$qry);
    if(mysqli_num_rows($r))
    {
        while($row=mysqli_fetch_assoc($r))
        {
            if($row["headcount"]=='Delivered')
            {
                $btn ="printed";
                $disabled="disabled";
                $txt="Delivered";
            }
            elseif($row["headcount"]=='Not Allowed')
            {
                $btn ="printed";
                $disabled="disabled";
                $txt="Not Allowed";
            }
            else
            {
            
  						$result=mysqli_query($conn,"update registered_list set headcount_date='$date',headcount='Delivered' where uid='".$_POST["d"]."' ");
  						$data['status']=false;
            
                
                $disabled="";
                $btn = "btn-success";
                $txt="Deliver";
            }
        $s_id=base64_encode($row["id"]);
        $data['html'] .="<tr>
            <td><a data-id='".base64_encode($row["uid"])."' class='btn $btn deliver' $disabled>$txt</a></td>
            <td>".$row["uid"]."</td>
            <td>".$row["name"]."</td>
            <td>".$row["category"]."</td>
            <td>".$row["city"]."</td>
            <td>".$row["mobile"]."</td>
            <td>".$row["email"]."</td>
            </tr>";
        }
    }
    else{
        $data['html'] .="<span style='font-size: 18px;'>No Results Found</span>";
    }
    echo json_encode($data);
}


//Certificate:Deliver btn
if(isset($_POST["Cdeliver"]))
{

    $date=date("d-m-Y h:i:sa");
     $qry="update `registered_list` set cert_date='$date',certificate='Delivered',Cprinted_by='".$_POST["by"]."' where uid='".base64_decode($_POST["uid"])."'";
     $r=mysqli_query($conn,$qry);
    if($r)
    {
        $status=true;
    }

    echo json_encode($status);

}
//Allow button in workshop
if(isset($_POST["Wallow"]))
{

    $date=date("d-m-Y h:i:sa");
     $qry="update `registered_list` ".$_POST["wcol"]."='Entered' where uid='".base64_decode($_POST["uid"])."'";
     $r=mysqli_query($conn,$qry);
    if($r)
    {
        $status=true;
    }

    echo json_encode($status);

}
if(isset($_POST["foodCheckin"]))
{   
    $data['status'] = false;
    $foodtoken = $_POST['foodtoken'];
    $qry="update `delegate_list` set ".$foodtoken."=1 where unique_id='".$_POST["uid"]."'";
    $r=mysqli_query($connect,$qry);
    if($r)
    {
        $status=true;
        $data['status'] = true;
        $data['success'] = "Successfully Checked Now";
    }

    echo json_encode($status);

}




?>
