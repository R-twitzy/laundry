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
    <title>Daftar Member</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header bg-dark">
                <h5 class="text-white">Data Member</h5>
            </div>
            <div class="card-body">
                <!-- tombol daftar -->
                <a href="form-member.php">
                    <button class="btn btn-outline-success btn-block">
                        Tambahkan Member
                    </button>
                </a>
                <hr>
                <!-- kotak pencarian data pelanggan -->
                <form action="list-member.php" method="get">
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
                        $sql = "select * from member
                        where id_member like '%$search%'
                        or nama_member like '%$search%'
                        or alamat like '%$search%'
                        or jenis_kelamin like '%$search%'
                        or tlp like '%$search%'";
                    } else {
                        $sql = "select * from member";
                    }
                    //eksekusi perintah sql
                    $query = mysqli_query($connect, $sql);
                    while($member = mysqli_fetch_array($query)){ ?>
                        <li class="list-group-item">
                        <div class="row">
                            <!-- bagian data member-->
                            <div class="col-lg-10 col-md-10">
                                <h5>Nama Member : <?php echo $member["nama_member"];?></h5>
                                <h6>ID Member : <?php echo $member["id_member"];?></h6>
                                <h6>Jenis Kelamin : <?php echo $member["jenis_kelamin"]?></h6>
                                <h6>Alamat Member : <?php echo $member["alamat"];?></h6>
                                <h6>Telepon : <?php echo $member["tlp"];?></h6>
                            </div>

                            <!-- bagian tombol pilihan-->
                            <div class="col-lg-2 col-md-2">
                                <a href="form-member.php?id_member=<?=$member["id_member"]?>">
                                    <button class="btn btn-block btn-outline-primary mb-1">
                                        Edit
                                    </button>
                                </a>
                                <a href="process-member.php?id_member=<?=$member["id_member"]?>">
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