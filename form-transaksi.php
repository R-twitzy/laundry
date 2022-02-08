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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Form Transaksi Laundry</title>
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header bg-dark">
                <h5 class="text-white">Form Transaksi Laundry</h5>
            </div>
            <div class="card-body">
                <?php
            if (isset($_GET["id_transaksi"])) {
                    // memeriksa ketika load file ini
                    // apakah membawa data GET dg nama "id_transaksi"
                    // jika true, maka form transaksi digunakan utk edit

                    # mengakses data status dan id
                    include "connection.php";
                    $id_transaksi = $_GET["id_transaksi"];
                    $sql = "select * from transaksi where id_transaksi='$id_transaksi'";
                    # eksekusi perintah sql
                    $hasil = mysqli_query($connect, $sql);
                    # konversi hasil query ke bentuk array
                    $transaksi = mysqli_fetch_array($hasil);

                    # mengakses data detil transaksi dari id_transaksi yg dikirim
                    include "connection.php";
                    $id_transaksi = $_GET["id_transaksi"];
                    $sql = "select * from detil_transaksi 
                    where id_transaksi='$id_transaksi'";
                    # eksekusi perintah sql
                    $hasil = mysqli_query($connect, $sql);
                    # konversi hasil query ke bentuk array
                    $detil = mysqli_fetch_array($hasil);
                    ?>

                <form action="process-transaksi.php" method="post">
                    ID transaksi
                    <input type="text" name="id_transaksi"
                    class="form-control mb-2" required
                    value="<?=$transaksi["id_transaksi"] ?>" readonly>
                    
                    Status transaksi
                    <select name="status" class="form-control mb-2" required>
                        <option value="<?=$transaksi["status"] ?>">
                            <?=$transaksi["status"] ?>
                        </option>
                        <option value="Baru">Baru</option>
                        <option value="Proses">Proses</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Diambil">Diambil</option>
                    </select>

                    <button type="submit" class="btn btn-primary btn-block"
                    name="edit_transaksi" onclick="return confirm('Apakah anda yakin?')">
                        Save
                    </button>
                </form>

                    <?php
                }else {
                    // jika false, maka form transaksi digunakan utk insert
                    ?>
                    <form action="process-transaksi.php" method="post">
                        <!-- input id transaksi (alhamdulillah id transaksi saya auto increment)-->

                        <!-- input tgl otomatis -->
                        <?php
                        date_default_timezone_set('Asia/Jakarta');
                        ?>
                        Tanggal transaksi
                        <input type="text" name="tgl" class="form-control mb-2"
                        value="<?=(date("Y-m-d H:i:s"))?>"readonly>

                        <!-- pilih member melalui nama -->
                        Pilih member
                        <select name="id_member" class="form-control mb-2" required>
                        <?php
                        include "connection.php";
                        $sql="select * from member";
                        $hasil= mysqli_query($connect, $sql);
                        while ($member= mysqli_fetch_array($hasil)) {
                            ?>
                            <option value="<?=($member["id_member"])?>">
                                <?=($member["nama_member"])?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                    
                        <!-- petugas ambil dari data login-->
                        <input type="hidden" name="id_user"
                        value="<?=($_SESSION["user"]["id_user"])?>">
                        Admin
                        <input type="text" name="nama_user" class="form-control mb-2"
                        value="<?=($_SESSION["user"]["nama_user"])?>" readonly>

                        Paket
                        <select name="id_paket" class="form-control mb-2" required>
                            <?php
                            include "connection.php";
                            $sql="select * from paket";
                            $hasil= mysqli_query($connect, $sql);
                            while ($paket= mysqli_fetch_array($hasil)) {
                                ?>
                                <option value="<?=($paket["id_paket"])?>">
                                    <?=($paket["jenis"])?> Rp <?=($paket["harga"])?>/qty
                                </option>
                                <?php
                            }
                            ?>
                        </select>

                        Qty
                        <input type="number" name="qty"
                        class="form-control mb-2" required>

                        Batas Waktu
                        <input type="date" name="batas_waktu"
                        class="form-control mb-2">


                        <button class="btn btn-block btn-primary" type="submit" name="simpan_transaksi">
                            Save
                        </button> 
                        <?php } ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>