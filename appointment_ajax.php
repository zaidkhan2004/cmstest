<?php

// Database connection info
$dbDetails = array(
    'host' => '45.79.126.214',
    'user' => 'cnejkyxsgu',
    'pass' => 'QBtwamct8W',
    'db'   => 'cnejkyxsgu'
);



// DB table to use
$table = 'patient';

// Table's primary key
$primaryKey = 'patient_id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
$columns = array(
    array( 'db' => 'patient_id',  'dt' => 0 ),
	array( 'db' => 'name',  'dt' => 1 ),
    array( 'db' => 'gender',  'dt' => 2 ),
	array( 'db' => 'age',  'dt' => 3 ),
	array( 'db' => 'mobile_no',  'dt' => 4 ),
	array( 'db' => 'old_patient_no',  'dt' => 5 )
);

// Include SQL query processing class
require( 'ssp.class.php' );

// Output data as json format
echo json_encode(
    SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns )
);



/*	
	$params = $columns = $totalRecords = $data = array();
 
	$params = $_REQUEST;
 
	$columns = array(
		0 => 'patient_id', 
		1 => 'name',
		2 => 'mobile_no'
	);

$sql= "select patient_id,name,mobile_no from patient;";
                                            $result = mysqli_query($conn, $sql);

											   $totalRecords = mysqli_num_rows($result);
                                               while($row = mysqli_fetch_row($result)) {
													$data[] = $row;
                                                } // end of while 
											//print_r($rows);
											
		$json_data = array(
		"draw"            => intval($params['draw'] ),   
		"recordsTotal"    => intval($totalRecords),  
		"recordsFiltered" => intval($totalRecords),
		"data"            => $data
	);
 

                                            echo json_encode($json_data);
*/

?>
