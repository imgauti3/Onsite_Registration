<?php
// Create and open new csv file

$file = fopen($csv, 'w');
// Get the table
$sqry = mysqli_query($connect, $exportQuery);
if (mysqli_num_rows($sqry) > 0) {
     while ($column = mysqli_fetch_field($sqry)) {
        $column_names[] = $column->name;
    }
    
        // Write column names in csv file
    if (!fputcsv($file, $column_names))
        die('Can\'t write column names in csv file');
    
    // Get table rows
    while ($row = mysqli_fetch_row($sqry)) {
        // Write table rows in csv files
        if (!fputcsv($file, $row))
            die('Can\'t write rows in csv file');
    }
fclose($file);
   
}

?>