<?php
session_start();
# jika saat load halaman ini, pastikan telah login sbg petugas
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
    <title>Form Petugas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header bg-dark">
                <h5 class="text-white">
                    Form user
                </h5>
            </div>
            <div class="card-body">
                <?php
                if (isset($_GET["id_user"])) {
                    #form utk edit
                    # mengakses data user dari id yg dikirim
                    include "connection.php";
                    $id_user = $_GET["id_user"];
                    $sql = "select * from user
                    where id_user='$id_user'";
                    # eksekusi perintah sql
                    $hasil = mysqli_query($connect, $sql);
                    # konversi hasil query ke bentuk array
                    $user = mysqli_fetch_array($hasil);
                    ?>
                    <form action="process-user.php" method="post"
                    enctype="multipart/form-data">
                        ID
                        <input type="number" name="id_user"
                        class="form-control mb-2" required
                        value="<?=$user["id_user"] ?>" readonly>

                        Nama
                        <input type="text" name="nama_user"
                        class="form-control mb-2" required
                        value="<?=$user["nama_user"] ?>">

                        Username
                        <input type="text" name="username"
                        class="form-control mb-2" required
                        value="<?=$user["username"] ?>">

                        Password
                        <input type="password" name="password"
                        class="form-control mb-2">

                        Role
                        <select name="role" class="form-control mb-2" required>
                            <option value="<?=$user["role"] ?>">
                                <?=$user["role"] ?>
                            </option>
                            <option value="admin">admin</option>
                            <option value="kasir">kasir</option>
                        </select>

                        <button type="submit" class="btn btn-primary btn-block" name="edit_user"
                        onclick="return confirm('Apakah anda yakin?')">
                            Save
                        </button>
                    </form>
                <?php
                } else {
                    #form utk insert ?>
                    <form action="process-user.php" method="post"
                    enctype="multipart/form-data">

                        Nama
                        <input type="text" name="nama_user"
                        class="form-control mb-2" required>

                        Username
                        <input type="text" name="username"
                        class="form-control mb-2" required>

                        Password
                        <input type="password" name="password"
                        class="form-control mb-2">

                        Role
                        <select name="role" class="form-control mb-2" required>
                            <option value="admin">admin</option>
                            <option value="kasir">kasir</option>
                        </select>

                        <button type="submit" class="btn btn-primary btn-block" name="simpan_user">
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