<?php
include("connection.php");

# untuk insert paket
if (isset($_POST["simpan_paket"])) {
    // tampubg data input paket dari user
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];

    // membuat perintah sql utk insert data ke tbl paket
    $sql = "insert into paket values ('', '$jenis','$harga')";

    // eksekusi perintah sql
    mysqli_query($connect, $sql);

    // direct ke halaman list paket
    header("location: list-paket.php");
}

# untuk edit paket
else if (isset($_POST["edit_paket"])) {
    // tampung data yg akan diupdate
    $id_paket = $_POST["id_paket"];
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];

    // membuat perintah sql untuk update data
    $sql = "update paket set jenis='$jenis',
    harga='$harga' where id_paket='$id_paket'";

    // eksekusi perintah sql
    mysqli_query($connect, $sql);

    // direct ke halaman list paket
    header("location: list-paket.php");
}

# untuk hapus paket
else if (isset($_GET["id_paket"])) {
    $id_paket = $_GET['id_paket'];
    $sql ="delete from paket where id_paket = '".$id_paket."'" ;

    $result = mysqli_query($connect,$sql);

    if ($result) {
        header('Location:list-paket.php');
    } else {
        printf('Gagal ya'.mysqli_error($connect));
        exit();
    }
}

?>