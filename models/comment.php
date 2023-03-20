<?php 

// if (isset($_POST['submit'])) {

//     $komentar = $_POST['comment'];
//     $username = $_POST['username'];
//     $id_karya = $_POST['id_karya'];
//     $id_user = $_POST['id_user'];
//     $profpic = $_POST['profpic'];

//     $insert = mysqli_query($conn, "INSERT INTO comment VALUES('$id_user', '$komentar', '$id_karya','$username', '$profpic)");

//     if ($insert) {
//         echo "<script>
//         alert('komentar berhasil');
//         </script>";
//     }else{
//         //if register failed
//         echo "<script>alert('komentar gagal');</script>";
//     }
    
    
//     return mysqli_affected_rows($conn);

// }

function setComments($conn) {

    if ( isset($_POST['commentSubmit']) ) {
        $id_user = $_POST['id_user'];
        $id_karya = $_POST['id_karya'];
        $username = $_POST['username'];
        $date = $_POST['date'];
        $messege = $_POST['comment'];
        $profpic = $_POST['profpic'];

        $sql = "INSERT INTO comments (id_user, id_karya, username, date, messege, profpic) VALUE ('$id_user', '$id_karya', '$username' ,'$date', '$messege', '$profpic')";
        $result = $conn->query($sql);

        header('Location: detail-pameranPage.php?id=' . $id_karya);
        // echo "<script>
        // window.location.href='detail-pameranPage.php?id=" . $id_karya . "';
        // </script>";
    }

}

function getComments($id_karya) {
    global $conn;
    $sql = "SELECT * FROM comments WHERE id_karya = $id_karya";
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