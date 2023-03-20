<?php

include 'config/connect.inc.php';

$errors[] = "";

if (isset($_POST['register'])) {

$email = mysqli_real_escape_string($conn, $_POST["email"]);
$username = strtolower(stripslashes($_POST["username"]));
$password = mysqli_real_escape_string($conn, $_POST["password"]);
$confirmpw = mysqli_real_escape_string($conn, $_POST["confirmpw"]);


//checking username to avoid duplicate
$username_check = "SELECT username FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $username_check);
if (mysqli_fetch_assoc($result)) {
    echo "<script>
            alert('username sudah terdaftar!');
          </script>";

    return false;
}

$email_check = "SELECT * FROM users WHERE email = '$email'";
$res = mysqli_query($conn, $email_check);
if(mysqli_num_rows($res) > 0){
    $errors ['email'] = "Email sudah terdaftar !";
}

//password confirm
if ($password !== $confirmpw) {
    echo"<script>
    alert('konfirmasi password tidak sesuai!');
    </script>";

    return false;
}

//password encryption
$password = password_hash($password, PASSWORD_DEFAULT);

//insert to db
$insert = mysqli_query($conn,"INSERT INTO users VALUES('', '$username', '$password','$email', 'none', 'none', 'none', 'default.png', 'Pengguna')");

if ($insert) {
    //if register succes
    echo "<script>
    alert('registrasi berhasil!');
    </script>";
    header('Location: masukPage.php');
}else{
    //if register failed
    echo "<script>alert('registrasi gagal');</script>";
}


return mysqli_affected_rows($conn);
}

?>