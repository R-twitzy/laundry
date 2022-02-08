<?php
include("connection.php");

# untuk insert user
if (isset($_POST["simpan_user"])) {
    // tampung data input user dari user
    $nama_user = $_POST["nama_user"];
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);
    $role = $_POST["role"];

    // membuat perintah sql utk insert data ke tbl user
    $sql = "insert into user values ('', '$nama_user','$username', 
    '$password', '$role')";

    // eksekusi perintah sql
    mysqli_query($connect, $sql);

    // direct ke halaman list user
    header("location: list-user.php");
    
}

# untuk edit user
else if (isset($_POST["edit_user"])) {
    // tampung data edit user dari user
    $id_user = $_POST["id_user"];
    $nama_user = $_POST["nama_user"];
    $username = $_POST["username"];
    $role = $_POST["role"];

    # jika update data 
    
        if (empty($_POST["password"])) {
            $sql = "update user set nama_user='$nama_user',
            role='$role', username='$username' where id_user='$id_user'";
        } else {
            $password = sha1($_POST["password"]);
            $sql = "update user set nama_user='$nama_user', 
            role='$role', username='$username', 
            password='$password' where id_user='$id_user'";
        }

            if (mysqli_query($connect, $sql)) {
                header("location:list-user.php");
            } else {
                echo "gagal boss";
            }
    
}

# untuk hapus user
else if (isset($_GET["id_user"])) {
    $id_user = $_GET['id_user'];
    $sql ="delete from user where id_user = '".$id_user."'" ;

    $result = mysqli_query($connect,$sql);

    if ($result) {
        header('Location:list-user.php');
    } else {
        printf('Gagal ya'.mysqli_error($connect));
        exit();
    }
}

?>