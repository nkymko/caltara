<?php

include '../config/connect.inc.php';

            
$sql = "SELECT * FROM pameran  ORDER BY id_pakaian ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
        
    }
    return $data;
} else{
    $error = true;
}

 ?>