<?php
$page = "edit";
require 'function.php';
session_start();

if (!isset($_SESSION['login'])) {
  echo "
  <script>
  alert('Login terlebih dahulu');
  document.location = '../auth/login';
  </script>";
}

$idt = $_GET["t"];

$diskon = query("SELECT * FROM diskon");
$user = query("SELECT * FROM user WHERE role = 'kasir'");
$outlet = query("SELECT * FROM outlet");
$paket = mysqli_query($conn, "SELECT * FROM paket");
$member = query("SELECT * FROM member");
$transaksi = query("SELECT *, member.nama AS namber, CONCAT(tahun,invoice,kode_invoice) AS INV FROM transaksi JOIN member USING (id_member) JOIN outlet USING (id_outlet) JOIN paket USING (id_paket) JOIN user USING (id_user) JOIN diskon USING (id_diskon) WHERE id_transaksi = $idt")[0];

$bank = ['BCA', 'BNI', 'BSI', 'MAN'];
$a = $bank[random_int(0, 3)];
$result = $a;


?>
<!DOCTYPE html>
<html>

<head>
  <title>Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css" rel="stylesheet">
  <link rel="icon" href="../private/assets/img/logo.png">
  <link rel="stylesheet" href="../private/assets/css/style.css">

  <style>

  </style>
</head>

<body>
  <div class="d-flex align-items-center justify-content-center flex-column vh-100 invoice">
    <div class="card shadow-lg" style="width: 600px;">
      <div class="card-body">
        <h2 class="text-center">Invoice Loandry</h2>
        <hr>
        <div class="container">
          <div class="row">
            <div class="col-md-8"><span class="fw-bold">Kepada :</span> <br>
              <?= $transaksi['namber'] ?>
            </div>
            <div class="col-md-4 float-end"><span class="fw-bold">Tanggal :</span> <br>
              <?= date('d F Y'); ?> <br> <br>
              <span class="fw-bold">No. Invoice :</span> <br>
              <?= $transaksi['INV'] ?>
            </div>
          </div>
        </div>

        <div class="container mt-4">
          <div class="row">
            <div class="table-responsive">
              <table class="table table-border">
                <thead>
                  <tr>
                    <th scope="col">Karyawan</th>
                    <th scope="col">Paket</th>
                    <th scope="col">qty</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody class="table-secondary">
                  <tr class="">
                    <td><?= $transaksi['nama'] ?></td>
                    <td><?= $transaksi['nama_paket'] ?></td>
                    <td><?= $transaksi['qty'] ?>kg</td>
                    <td>Rp.<?= ($transaksi['harga'] * $transaksi['qty']) - 1000 - $transaksi['diskon'] - $transaksi['pajak'] ?></td>
                  </tr>
                </tbody>
              </table>
              <div>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-8">
              <span class="fw-bold">Pembayaran:</span> <br>
              Nama : <?= $a ?> <br>
              No.Rek : <?= rand(100, 199) ?>-<?= rand(400, 500) ?>-<?= rand(5000, 9000) ?>
            </div>
            <div class="col-md-4">
              <span class="fw-bold">Status :</span> <br>
              <?= $transaksi['status'] ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    window.onload = function() {
      window.print();
    }
  </script>
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</html>