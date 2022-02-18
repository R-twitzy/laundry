<?php
session_start();
# jika saat load halaman ini, pastikan telah login sbg user
if (!isset($_SESSION["user"])) {
    header("location:login.php");
}
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Data Peminjaman</title>
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header bg-dark">
                <h5 class="text-white">
                    Daftar Sewa
                </h5>
            </div>
            <div class="card-body">
                <!-- tombol tambah -->
                <a href="form-transaksi.php">
                    <button class="btn btn-outline-success btn-block">
                        transaksi
                    </button>
                </a>
                <hr>
                <ul class="list-group">
                    <?php
                    include "connection.php";
                    
                    $sql = "select transaksi.*,member.*,user.* from transaksi 
                    inner join member on transaksi.id_member=member.id_member
                    inner join user on transaksi.id_user=user.id_user
                    order by id_transaksi desc";

                    $hasil = mysqli_query($connect, $sql);
                    while($transaksi = mysqli_fetch_array($hasil)){
                        ?>
                        <li class="list-group-item">
                            <div class="row">
                                <!-- Status dan pembayaran-->
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <h5>
                                            <div class="badge badge-info">
                                                <?=$transaksi["status"] ?>
                                            </div>
                                        <?php 
                                        if ($transaksi["dibayar"]== "belum_dibayar") { ?>
                                            <div class="badge badge-warning">
                                                Belum dibayar
                                            </div> 
                                            <a href="process-bayar.php?id_transaksi=<?=($transaksi["id_transaksi"])?>"
                                            onclick="return confirm('Apakah anda yakin?')">
                                            <button class="badge btn btn-outline-info mx-1">Bayar</button>
                                            </a>
                                            <?php } 
                                        elseif ($transaksi["dibayar"]== "dibayar") { ?>
                                            <div class="badge badge-secondary">
                                                Telah Dibayar Pada <?=($transaksi["tgl_bayar"])?>
                                            </div> 
                                            <!-- <h6>
                                                Bayar: Rp <?=(number_format($paket["harga"],2))?>
                                            </h6>--> <?php } ?>
                                    </h5>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 d-flex flex-row-reverse">
                                    <a href="form-transaksi.php?id_transaksi=<?=($transaksi["id_transaksi"])?>">
                                        <button class="badge btn btn-outline-primary mx-1">Ubah Status</button>
                                    </a>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-info">Kode transaksi</small>
                                    <h5><?=($transaksi["id_transaksi"])?></h5>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-info">Pelanggan</small>
                                    <h5><?=($transaksi["nama_member"])?></h5>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-info">Admin</small>
                                    <h5><?=($transaksi["nama_user"])?></h5>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-info">Tgl. Transaksi</small>
                                    <h5><?=($transaksi["tgl"])?></h5>
                                </div>
                            </div>
                            <small class="text-success">List Laundry</small><br>
                            
                                <?php
                                    $id_transaksi= $transaksi["id_transaksi"];
                                    $sql = "select * from detil_transaksi
                                    inner join paket on detil_transaksi.id_paket = paket.id_paket
                                    where id_transaksi = '$id_transaksi'";

                                    $hasil_paket = mysqli_query($connect, $sql);
                                    while($paket = mysqli_fetch_array($hasil_paket)){
                                    ?>
                                        <small>
                                            <b><?=($paket["jenis"])?> x <?=($paket["qty"])?></b>
                                            <i class="ml-1 text-primary">Biaya: Rp <?=(number_format($paket["harga"] * $paket["qty"]))?></i> <br>
                                        </small> <?php
                                    }
                                ?>
                            
                            
                        </li>
                        <?php
                    } 
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>