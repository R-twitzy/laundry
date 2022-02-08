<?php
include "connection.php";

#untuk insert
if (isset($_POST["simpan_transaksi"])) {
    // tampung inputan
    $tgl = $_POST["tgl"];
    $id_member = $_POST["id_member"];
    $id_user = $_POST["id_user"];
    $batas_waktu = $_POST["batas_waktu"];
    $paket = $_POST["id_paket"];
    $qty = $_POST["qty"];

    // perintah sql utk insert ke tabel transaksi
    $sql="insert into transaksi values
    ('','$id_member', '$tgl', '$batas_waktu', ' ', 'Baru', 'belum_dibayar', '$id_user')";
    if (mysqli_query($connect, $sql)) {
        # jika insert berhasil
        # insert ke tabel detil_transaksi
        $sql="select * from transaksi order by id_transaksi desc";
        $transaksi = mysqli_query($connect, $sql);
        $array = mysqli_fetch_array($transaksi);
        $id_transaksi= $array["id_transaksi"];
            $id_paket = $paket[$id_paket];
            $sql = "insert into detil_transaksi values (' ', '$id_transaksi', '$id_paket', '$qty')";
            if (mysqli_query($connect, $sql)){
                header("location: list-transaksi.php");
            }else {
                echo mysqli_error($connect);
            }
        }else {
        # jika gagal
        echo mysqli_error($connect);
    }
}

# untuk edit status
else if (isset($_POST["edit_transaksi"])) {
    // tampung data yg akan diupdate
    $id_transaksi = $_POST["id_transaksi"];
    $status = $_POST["status"];

    // membuat perintah sql untuk update data
    $sql = "update transaksi set status='$status'
    where id_transaksi='$id_transaksi'";

    // eksekusi perintah sql
    mysqli_query($connect, $sql);

    // direct ke halaman list transaksi
    header("location: list-transaksi.php");
}



?>