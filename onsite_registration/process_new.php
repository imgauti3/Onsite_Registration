
<?php
session_start();
include_once('db.php');

$db = new DB();

if (isset($_POST["searchKey"]) && $_POST["search"] == 1) {
    $qry = "SELECT * FROM `delegate_list` where concat(unique_id,' ',fullname,' ',reg_category,'  ',mobileno,' ',emailid,' ',place) like '%" . $_POST["searchKey"] . "%'";
    $r = mysqli_query($connect, $qry);
    if (mysqli_num_rows($r)) {
        while ($row = mysqli_fetch_assoc($r)) {
            if($row["certificate_printed_date"]!='')
            {
                $cls ="btn-danger";
                $dis="print";
            } else if ($row["certificate_printed"] == 0) {
                $dis="disabled";
            }
            else
            {
                $dis="print";
                $cls = "btn-success";
            }
            
            $s_id=$row["unique_id"];
            $jsondata = json_encode($row);
            $data = "<a data-id='".$s_id."' data-name='".$row['fullname']."' style='margin: 10px;' class='userViewModal'><span style='margin: 10px;'>".$row['fullname']."</span></a><br>";
            echo $data;
        }
    } else {
        echo "<span style='font-size: 18px;'>No Results Found</span>";
    }
}

?>