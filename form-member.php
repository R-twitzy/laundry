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
    <title>Form Member</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header bg-dark">
                <h5 class="text-white">Form Member</h5>
            </div>

            <div class="card-body">
                <?php
                if (isset($_GET["id_member"])) {
                    // memeriksa ketika load file ini
                    // apakah membawa data GET dg nama "id_member"
                    // jika true, maka form member digunakan utk edit

                    # mengakses data member dari id_member yg dikirim
                    include "connection.php";
                    $id_member = $_GET["id_member"];
                    $sql = "select * from member where id_member='$id_member'";
                    # eksekusi perintah sql
                    $hasil = mysqli_query($connect, $sql);
                    # konversi hasil query ke bentuk array
                    $member = mysqli_fetch_array($hasil);
                    ?>

                <form action="process-member.php" method="post">
                    ID Member
                    <input type="text" name="id_member"
                    class="form-control mb-2" required
                    value="<?=$member["id_member"] ?>" readonly>

                    Nama Member
                    <input type="text" name="nama_member"
                    class="form-control mb-2" required
                    value="<?=$member["nama_member"] ?>">
                    
                    Jenis Kelamin
                    <select name="jenis_kelamin" class="form-control mb-2" required>
                        <option value="<?=$member["jenis_kelamin"] ?>">
                            <?=$member["jenis_kelamin"] ?>
                        </option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>

                    Alamat Member
                    <input type="text" name="alamat"
                    class="form-control mb-2" required
                    value="<?=$member["alamat"] ?>">

                    Telepon
                    <input type="text" name="tlp"
                    class="form-control mb-2" required
                    value="<?=$member["tlp"] ?>">

                    <button type="submit" class="btn btn-primary btn-block"
                    name="edit_member" onclick="return confirm('Apakah anda yakin?')">
                        Save
                    </button>
                </form>

                    <?php
                }else {
                    // jika false, maka form member digunakan utk insert
                    ?>

                <form action="process-member.php" method="post">
                Nama Member
                    <input type="text" name="nama_member"
                    class="form-control mb-2" required>
                    
                    Jenis Kelamin
                    <select name="jenis_kelamin" class="form-control mb-2" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>

                    Alamat Member
                    <input type="text" name="alamat"
                    class="form-control mb-2" required>

                    Telepon
                    <input type="text" name="tlp"
                    class="form-control mb-2" required>

                    <button type="submit" class="btn btn-primary btn-block"
                    name="simpan_member" onclick="return confirm('Apakah anda yakin?')">
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