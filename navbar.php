<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Weeelaundry</title>
    <style>
      .nav{
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(9.1px);
        opacity: 0.9;
      }
      .bg {
        background-image: linear-gradient(to bottom, #f3deea, #efdeee, #eadef1, #e4def4, #dddff6, #d8e2f9, #d4e5fb, #cfe8fc, #ceeefd, #cff3fd, #d1f8fc, #d6fcfa);
      }
    </style>
</head>
<body class="bg">
<nav class="nav navbar navbar-expand navbar-light bg-white fixed-top">
  <a class="navbar-brand text-primary ml-3 h1" href="index.php"><b>Weeelaundry</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto mb-2">
      <li class="nav-item">
          <a class="nav-link" href="list-member.php">Member</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="list-transaksi.php">Transaksi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="list-paket.php">Paket</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="list-user.php">User</a>
        </li>
      </li>
    </ul>
    <a class="nav-link h6 text-danger" href="login.php">Logout</a>
  </div>
</nav> <hr>
</body>
</html>