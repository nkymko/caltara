<?php

include '../config/connect.inc.php';

$daerah = "";
$keyword = "";

if (isset($_POST['search'])) {
    $daerah = $_POST['filter_daerah'];
    $keyword = $_POST['keyword'];
}

$filter = '%'. $daerah .'%';
$search = '%'. $keyword .'%';
                
$sql = "SELECT * FROM pakaian_adat WHERE daerah LIKE ? AND (nama_pakaian LIKE ? OR daerah LIKE ? OR deskripsi LIKE ?) ORDER BY id_pakaian ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssss', $filter, $search, $search, $search);
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