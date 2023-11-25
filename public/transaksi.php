<?php
$page = "transaksi";
require '../private/config/function.php';
session_start();

if (!isset($_SESSION['login'])) {
  echo "
  <script>
  alert('Login terlebih dahulu');
  document.location = '../auth/login';
  </script>";
}

$diskon = query("SELECT * FROM diskon");
$user = query("SELECT * FROM user WHERE role = 'kasir'");
$outlet = query("SELECT * FROM outlet");
$paket = mysqli_query($conn, "SELECT * FROM paket");
$member = query("SELECT * FROM member");
$transaksi = mysqli_query($conn, "SELECT *, member.nama AS namber, CONCAT(tahun,invoice,kode_invoice) AS INV FROM transaksi JOIN member USING (id_member) JOIN outlet USING (id_outlet) JOIN paket USING (id_paket) JOIN user USING (id_user) JOIN diskon USING (id_diskon)");
$tsk = mysqli_fetch_assoc($transaksi);


if (isset($_POST['send'])) {
  if (addTransaksi($_POST) > 0) {
    echo "
    <script>
    alert('Berhasil');
    document.location = 'transaksi';
    </script>";
  } else {
    echo "<script> alert('Gagal!') </script>";
    header("Location: transaksi");
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <title>Produk</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css" rel="stylesheet">
  <link rel="icon" href="../private/assets/img/logo.png">
  <link rel="stylesheet" href="../private/assets/css/style.css">

</head>

<body>

  <div class="side">
    <?php require '../private/components/sidebar.php'; ?>
  </div>

  <div class="container" style="margin-top: 100px;">
    <div class="row"">
      <div class=" col-xl-4 mb-3">
      <div class="carda card">
        <div class="card-header">
          Transaksi
        </div>
        <div class="card-body">
          <form action="" method="post">
            <label for="member" class="form-label">Member :</label>
            <select name="member" class="form-select mb-3" id="member" required oninvalid="this.setCustomValidity('pilih salah satu terlebih dahulu!')" oninput="this.setCustomValidity('')">
              <option selected disabled hidden label=""></option>
              <option disabled>== Pilih Member ==</option>
              <?php foreach ($member as $item) : ?>
                <option value="<?= $item['id_member'] ?>"><?= $item['nama'] ?></option>
              <?php endforeach; ?>
            </select>
            <label for="paket" class="form-label">Paket :</label>
            <select name="paket" class="form-select mb-3" id="paket" required oninvalid="this.setCustomValidity('pilih salah satu terlebih dahulu!')" oninput="this.setCustomValidity('')">
              <option selected disabled hidden label=""></option>
              <option disabled>== Pilih Paket ==</option>
              <?php foreach ($paket as $item) : ?>
                <option value="<?= $item['id_paket'] ?>"><?= $item['nama_paket'] ?></option>
              <?php endforeach; ?>
            </select>
            <label for="outlet" class="form-label">Outlet :</label>
            <select name="outlet" class="form-select mb-3" id="outlet" required oninvalid="this.setCustomValidity('pilih salah satu terlebih dahulu!')" oninput="this.setCustomValidity('')">
              <option selected disabled hidden label=""></option>
              <option disabled>== Pilih Outlet ==</option>
              <?php foreach ($outlet as $item) : ?>
                <option value="<?= $item['id_outlet'] ?>"><?= $item['nama'] ?></option>
              <?php endforeach; ?>
            </select>
            <label for="diskon" class="form-label">Diskon :</label>
            <select name="diskon" class="form-select mb-3" id="diskon" required oninvalid="this.setCustomValidity('pilih salah satu terlebih dahulu!')" oninput="this.setCustomValidity('')">
              <option selected disabled hidden label=""></option>
              <option disabled>== Pilih Diskon ==</option>
              <?php foreach ($diskon as $item) : ?>
                <option value="<?= $item['id_diskon'] ?>"><?= $item['nama_diskon'] ?></option>
              <?php endforeach; ?>
            </select>
            <label for="user" class="form-label">Karyawan :</label>
            <select name="user" class="form-select mb-3" id="outlet" required oninvalid="this.setCustomValidity('pilih salah satu terlebih dahulu!')" oninput="this.setCustomValidity('')">
              <option selected disabled hidden label=""></option>
              <option disabled>== Pilih PJ ==</option>
              <?php foreach ($user as $item) : ?>
                <option value="<?= $item['id_user'] ?>"><?= $item['nama'] ?></option>
              <?php endforeach; ?>
            </select>
            <div class="input-group mb-3">
              <div class="form-floating">
                <input type="number" name="quantity" class="form-control" id="floatingInputGroup1" placeholder="Berat">
                <label for="floatingInputGroup1">Satuan</label>
              </div>
              <span class="input-group-text">Kg</span>
            </div>
        </div>
        <div class="card-footer text-muted">
          <button type="submit" class="btn btn-success float-end" name="send">Kirim</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-xl-8 mb-3">
      <div class="carda table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="text-white text-center" style="background-color: #304362;">
            <tr>
              <th scope="col" style="width: 10px;">INV</th>
              <th scope="col">Nama</th>
              <th scope="col">Karyawan</th>
              <th scope="col">Paket</th>
              <th scope="col">qty</th>
              <th scope="col">Status</th>
              <th scope="col">Total</th>
              <th scope="col">Detail</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            ?>
            <tr class="">
              <?php if ($tsk == NULL) {
                echo '<td colspan="13" class="text-center">data kosong</td>';
              } ?>
              <?php foreach ($transaksi as $items) : ?>
                <td scope="row"><?= $items['INV'] ?></td>
                <td><?= $items['namber'] ?></td>
                <td><?= $items['nama'] ?></td>
                <td><?= $items['nama_paket'] ?></td>
                <td><?= $items['qty'] ?>kg</td>
                <td><?= $items['status'] ?></td>
                <td>Rp.<?= ($items['harga'] * $items['qty']) - 1000 - $items['diskon'] - $items['pajak'] ?></td>
                <td class="text-center">
                  <a href="../private/config/detTrans?t=<?= $items['id_transaksi'] ?>" onclick="return confirm('Proses ke Invoice?')" class="badge btn text-dark <?= $items['status'] == 'dibayar' ? '' : 'd-none' ?>"><i class="ri-file-pdf-2-fill"></i></a>
                  <a href="../private/config/bayar?t=<?= $items['id_transaksi'] ?>" onclick="return confirm('Bayar?')" class="badge btn text-dark <?= $items['status'] == 'dibayar' ? 'd-none' : '' ?>"><i class="ri-money-dollar-circle-line"></i></a>
                  <a href="../private/config/delTrans?t=<?= $items['id_transaksi'] ?>" onclick="return confirm('Hapus Transaksi?')" class="badge btn text-dark <?= $_SESSION['role'] == 'kasir' ? 'd-none' : '' ?>"><i class="ri-delete-bin-5-line"></i></a>
                </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>



</body>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</html>