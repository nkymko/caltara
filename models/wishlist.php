<?php 

function setWishlist($conn){
    
    if ( isset($_POST['addWish']) ) {
        $id_user = $_POST['id_user'];
        $id_karya = $_POST['id_karya'];
        $foto_karya = $_POST['foto_karya'];

        $sql = "INSERT INTO wishlist (id_user, id_karya, foto_karya) VALUE ($id_user, $id_karya, '$foto_karya')";
        $result = $conn->query($sql);

        header('Location: detail-pameranPage.php?id=' . $id_karya);

    }

}

function getWishlist($id_user, $id_karya) {
    global $conn;
    $sql = "SELECT * FROM wishlist WHERE id_user = $id_user AND id_karya = $id_karya";
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

function getWishlistProfil($id_user) {
    global $conn;
    $sql = "SELECT * FROM wishlist WHERE id_user = $id_user";
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

function delWishlist($conn){
    
    if ( isset($_POST['delWish']) ) {
        $id_karya = $_POST['id_karya'];

        $sql = "DELETE FROM wishlist WHERE id_karya = $id_karya";
        $result = $conn->query($sql);

        header('Location: detail-pameranPage.php?id=' . $id_karya);

    }

}

?>