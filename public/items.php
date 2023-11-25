<?php
$page = "produk";
require '../private/config/function.php';
session_start();

if (!isset($_SESSION['login'])) {
  echo "
  <script>
  alert('Login terlebih dahulu');
  document.location = '../auth/login';
  </script>";
}


$outlet = query("SELECT * FROM outlet");
$paket = mysqli_query($conn, "SELECT * FROM paket JOIN outlet AS o USING(id_outlet)");
$pkt = mysqli_fetch_assoc($paket);


if (isset($_POST['send'])) {
  if (addProduk($_POST) > 0) {
    echo "
    <script>
    alert('Berhasil');
    document.location = 'items';
    </script>";
  } else {
    echo "<script> alert('Gagal!') </script>";
    header("Location: items");
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
    <?php require '../private/components/sidebar.php' ?>
  </div>

  <div class="container" style="margin-top: 100px;">
    <div class="row"">
      <div class=" col-xl-5 mb-3 <?= $_SESSION['role'] == 'kasir' ? 'd-none' : '' ?>">
      <div class="carda card">
        <div class="card-header">
          Tambah Paket
        </div>
        <div class="card-body">
          <form action="" method="post">
            <label for="outlet" class="form-label">Outlet :</label>
            <select name="outlet" class="form-select mb-3" id="outlet" required oninvalid="this.setCustomValidity('pilih salah satu terlebih dahulu!')" oninput="this.setCustomValidity('')">
              <option selected disabled hidden label=""></option>
              <option disabled>== Pilih Outlet ==</option>
              <?php foreach ($outlet as $item) : ?>
                <option value="<?= $item['id_outlet'] ?>"><?= $item['nama'] ?></option>
              <?php endforeach; ?>
            </select>
            <label for="jenis" class="form-label">Jenis :</label>
            <input type="text" class="form-control mb-3" name="jenis" id="jenis" required>
            <label for="nmPaket" class="form-label">Nama Paket :</label>
            <input type="text" class="form-control mb-3" name="nmPaket" id="nmPaket" required>
            <label for="harga" class="form-label">Harga :</label>
            <input type="number" class="form-control" name="harga" id="harga" required>
        </div>
        <div class="card-footer text-muted">
          <button type="submit" class="btn btn-success float-end" name="send">Kirim</button>
          </form>
        </div>
      </div>
    </div>
    <div class="mb-3 <?= $_SESSION['role'] == 'kasir' ? 'col-md-12' : 'col-md-7' ?>">
      <div class="carda table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="text-white text-center" style="background-color: #304362;">
            <tr>
              <th scope="col" style="width: 10px;">No</th>
              <th scope="col">Outlet</th>
              <th scope="col">Jenis</th>
              <th scope="col">Nama Paket</th>
              <th scope="col">Harga</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            ?>
            <tr class="">
              <?php if ($pkt == NULL) {
                echo '<td colspan="6" class="text-center">data kosong</td>';
              } ?>
              <?php foreach ($paket as $items) : ?>
                <td scope="row"><?= $i++; ?>.</td>
                <td><?= $items['nama'] ?></td>
                <td><?= $items['jenis'] ?></td>
                <td><?= $items['nama_paket'] ?></td>
                <td>Rp.<?= $items['harga'] ?>/kg</td>
                <td class="text-center">
                  <a href="../private/config/editPaket?ip=<?= $items['id_paket'] ?>" class="badge btn text-dark"><i class="ri-edit-line"></i></a>
                  <a href="../private/config/delPaket?iu=<?= $items['id_paket'] ?>" onclick="return confirm('Yakin untuk hapus?')" class="badge btn text-dark"><i class="ri-delete-bin-line"></i></a>
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