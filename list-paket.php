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
    <title>Daftar paket</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header bg-dark">
                <h5 class="text-white">Data paket</h5>
            </div>
            <div class="card-body">
                <!-- tombol daftar -->
                <a href="form-paket.php">
                    <button class="btn btn-outline-success btn-block">
                        Tambahkan paket
                    </button>
                </a>
                <hr>
                <!-- kotak pencarian data pelanggan -->
                <form action="list-paket.php" method="get">
                    <input type="text" name="search"
                    class="form-control mb-3"
                    placeholder="Masukan Keyword Pencarian"
                    required>
                </form>
                <ul class="list-group">
                    <?php
                    include("connection.php");
                    if (isset($_GET["search"])) {
                        # jika pd saat load halaman ini
                        # akan mengecek apakah ada data dgn method
                        # GET yg bernama search
                        $search = $_GET["search"];
                        $sql = "select * from paket
                        where id_paket like '%$search%'
                        or jenis like '%$search%'
                        or harga like '%$search%'";
                    } else {
                        $sql = "select * from paket";
                    }
                    //eksekusi perintah sql
                    $query = mysqli_query($connect, $sql);
                    while($paket = mysqli_fetch_array($query)){ ?>
                        <li class="list-group-item">
                        <div class="row">
                            <!-- bagian data paket-->
                            <div class="col-lg-10 col-md-10">
                                <h5>Jenis paket : <?php echo $paket["jenis"];?></h5>
                                <h6>ID paket : <?php echo $paket["id_paket"];?></h6>
                                <h6>Harga : <?php echo $paket["harga"]?>/qty</h6>
                            </div>

                            <!-- bagian tombol pilihan-->
                            <div class="col-lg-2 col-md-2">
                                <a href="form-paket.php?id_paket=<?=$paket["id_paket"]?>">
                                    <button class="btn btn-block btn-outline-primary mb-1">
                                        Edit
                                    </button>
                                </a>
                                <a href="process-paket.php?id_paket=<?=$paket["id_paket"]?>">
                                    <button class="btn btn-block btn-danger"
                                    onclick="return confirm('Apakah anda yakin?')">
                                        Remove
                                    </button>
                                </a>
                            </div>
                        </div>
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