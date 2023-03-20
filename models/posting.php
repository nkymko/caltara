<?php 



function getPost($id_user) {
    global $conn;
    $sql = "SELECT * FROM pameran WHERE id_user = $id_user";
    $result = $conn->query($sql);
    while ( $row = $result->fetch_assoc() ) {
        $data[] = $row;
    }
    if ( !empty($data) ) {
        return $data;
    } else {
        $error = true;
    }

}
?>