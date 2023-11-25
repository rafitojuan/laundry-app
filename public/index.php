<?php
$page = "index";
require '../private/config/function.php';
session_start();

if (!isset($_SESSION['login'])) {
  echo "
  <script>
  alert('Login terlebih dahulu');
  document.location = '../auth/login';
  </script>";
}

$paket = mysqli_query($conn, "SELECT * FROM paket JOIN outlet AS o USING(id_outlet)");
$jmlhPaket = mysqli_num_rows($paket);

$kustomer = mysqli_query($conn, "SELECT * FROM member");
$jmlhMember = mysqli_num_rows($kustomer);

$outlet = mysqli_query($conn, "SELECT * FROM outlet");
$jmlhOutlet = mysqli_num_rows($outlet);
?>

<!doctype html>
<html lang="en">

<head>
  <title>Dashboard</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <link rel="icon" href="../private/assets/img/logo.png">

</head>

<body>
  <style>
    .cardu {
      transition: all 0.5s ease-in-out;
      color: black;
    }

    .cardu:hover {
      box-shadow: 0 16px 24px 0 rgba(0, 0, 0, 0.2);
      background-color: #304362;
      color: white;
    }
  </style>

  <div class="side">
    <?php require '../private/components/sidebar.php' ?>
  </div>

  <div class="container" style="margin-top: 100px;">
    <div class="row"">
      <div class=" col-xl-4 mb-3">
      <div class="cardu card border-primary">
        <div class="card-body">
          <h4 class="card-title">Kustomer</h4>
          <p class="card-text"><?= $jmlhMember ?></p>
        </div>
      </div>
    </div>
    <div class="col-xl-4 mb-3">
      <div class="cardu card border-primary">
        <div class="card-body">
          <h4 class="card-title">Paket</h4>
          <p class="card-text"><?= $jmlhPaket ?></p>
        </div>
      </div>
    </div>
    <div class="col-xl-4">
      <a href="../public/items.php" class="cardu card border-primary">
        <div class="card-body">
          <h4 class="card-title">Outlet</h4>
          <p class="card-text"><?= $jmlhOutlet ?></p>
        </div>
      </a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>