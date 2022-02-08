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
    <title>Document</title>
    <style>
        #kotak{
            border-radius: 90px;
            height: 450px;
            position: relative;
            top: -100px;
            left: -125px;
            padding-top: 15%;
            padding-left: 15%;
        }
        /* Make the image fully responsive */
        .carousel-inner img {
          width: 100%;
          height: 100%;
        }
    </style>
</head>
<body>
<div id="demo" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">v>
    <div class="carousel-item active mt-2">
      <img src="img/weeekly-zoa.gif" alt="New York" width="1100" height="500">
      <div class="carousel-caption">
        <b><h2>Selamat Datang! <?=($_SESSION["user"]["nama_user"])?></h2></b>
        <a href="form-transaksi.php"><h3><button class="badge btn btn-info">
                Buat Laundry
        </button></h3></a>
      </div>   
    </div>
  </div>
</div>
</body>
</html>