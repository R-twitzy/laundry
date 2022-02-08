<?php
include "connection.php";
$id_transaksi = $_GET["id_transaksi"];
date_default_timezone_set('Asia/Jakarta');
$tgl_bayar = date_create(date("Y-m-d H:i:s"));
$tgl_bayar_fix = date("Y-m-d H:i:s");

// insert ke tabel bayar
$sql = "update transaksi set tgl_bayar='$tgl_bayar_fix', dibayar='dibayar'
        where id_transaksi='$id_transaksi'";
if (mysqli_query($connect, $sql)){
    header("location: list-transaksi.php");
}else {
    echo mysqli_error($connect);
}
?>