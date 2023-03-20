<?php 

include '../config/connect.inc.php';

function getdetail($query){
    global $conn;
    $stmt = $conn->prepare($query); 
    $stmt->execute();
    $result = $stmt->get_result();
	while( $row = $result->fetch_assoc() ){
		$rows[] = $row;
	}
	return $rows;
}

?>