<?php
// Create and open new csv file

$file = fopen($csv, 'w');
// Get the table
$sqry = mysqli_query($connect, $exportQuery);
if (mysqli_num_rows($sqry) > 0) {
     while ($column = mysqli_fetch_field($sqry)) {
        $column_names[] = $column->name;
    }
     $column_names[] = 'Reg Type';
        // Write column names in csv file
    if (!fputcsv($file, $column_names))
        die('Can\'t write column names in csv file');
    
    // Get table rows
    while ($row = mysqli_fetch_row($sqry)) {
		$sqluser=mysqli_query($connect,"select * from registration where uid='".$row[0]."'");
        $rowuser=mysqli_fetch_assoc($sqluser);
        $rowregcatid=$rowuser['reg_category_type'];
		
		$sqluserregfee=mysqli_query($connect,"select * from reg_type_fee where id='$rowregcatid'");
        $rowuserregfee=mysqli_fetch_assoc($sqluserregfee);
        $rowregfeecatid=$rowuserregfee['category'];
		$row[]=$rowregfeecatid;
        // Write table rows in csv files
        if (!fputcsv($file, $row))
            die('Can\'t write rows in csv file');
    }
fclose($file);
   
}

?>