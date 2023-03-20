<?php 

function setHistory($conn) {

    if ( isset($_POST['buy']) ) {
        $id_user = $_POST['id_user'];
        $id_karya = $_POST['id_karya'];
        $nama_karya = $_POST['nama_karya'];
        $foto_karya = $_POST['foto_karya'];
        $harga = $_POST['harga'];

        $sql = "INSERT INTO riwayat_pembelian (id_user, id_karya, nama_karya, harga, status, gambar_karya) VALUE ('$id_user', '$id_karya', '$nama_karya' , $harga ,'Menunggu Konfirmasi', '$foto_karya')";
        $result = $conn->query($sql);

        header('Location: pameranPage.php');

    }

}

function getHistory($id_user) {
    global $conn;
    $sql = "SELECT * FROM riwayat_pembelian WHERE id_user = $id_user";
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