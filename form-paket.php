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
    <title>Form paket</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header bg-dark">
                <h5 class="text-white">Form paket</h5>
            </div>

            <div class="card-body">
                <?php
                if (isset($_GET["id_paket"])) {
                    // memeriksa ketika load file ini
                    // apakah membawa data GET dg nama "id_paket"
                    // jika true, maka form paket digunakan utk edit

                    # mengakses data paket dari id_paket yg dikirim
                    include "connection.php";
                    $id_paket = $_GET["id_paket"];
                    $sql = "select * from paket where id_paket='$id_paket'";
                    # eksekusi perintah sql
                    $hasil = mysqli_query($connect, $sql);
                    # konversi hasil query ke bentuk array
                    $paket = mysqli_fetch_array($hasil);
                    ?>

                <form action="process-paket.php" method="post">
                    ID paket
                    <input type="text" name="id_paket"
                    class="form-control mb-2" required
                    value="<?=$paket["id_paket"] ?>" readonly>

                    Jenis paket
                    <select name="jenis" class="form-control mb-2" required>
                        <option value="<?=$paket["jenis"] ?>">
                            <?=$paket["jenis"] ?>
                        </option>
                        <option value="Kiloan">Kiloan</option>
                        <option value="Selimut">Selimut</option>
                        <option value="Bed cover">Bed cover</option>
                        <option value="Kaos">Kaos</option>
                    </select>

                    Harga
                    <input type="number" name="harga"
                    class="form-control mb-2" required
                    value="<?=$paket["harga"] ?>">

                    <button type="submit" class="btn btn-primary btn-block"
                    name="edit_paket" onclick="return confirm('Apakah anda yakin?')">
                        Save
                    </button>
                </form>

                    <?php
                }else {
                    // jika false, maka form paket digunakan utk insert
                    ?>

                <form action="process-paket.php" method="post">
                    Jenis paket
                    <select name="jenis" class="form-control mb-2" required>
                        <option value="Kiloan">Kiloan</option>
                        <option value="Selimut">Selimut</option>
                        <option value="Bed cover">Bed cover</option>
                        <option value="Kaos">Kaos</option>
                    </select>

                    Harga
                    <input type="number" name="harga"
                    class="form-control mb-2" required>

                    <button type="submit" class="btn btn-primary btn-block"
                    name="simpan_paket" onclick="return confirm('Apakah anda yakin?')">
                        Save
                    </button>
                </form>

                    <?php
                }
                ?>
                
            </div>
        </div>
    </div>
</body>
</html>