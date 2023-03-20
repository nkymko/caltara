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
                
$sql = "SELECT * FROM upacara_adat WHERE daerah LIKE ? AND (nama_upacara LIKE ? OR daerah LIKE ?) ORDER BY id ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $filter, $search, $search);
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