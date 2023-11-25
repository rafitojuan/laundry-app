<?php
$page = "edit";
require 'function.php';
session_start();

$id = $_GET["ip"];
$outlet = query("SELECT * FROM outlet");
$paket = mysqli_query($conn, "SELECT * FROM paket JOIN outlet AS o USING(id_outlet) WHERE id_paket = $id");
$pkt = mysqli_fetch_assoc($paket);


if (isset($_POST['uptPaket'])) {
  if (updateProduk($_POST) > 0) {
    echo "
    <script>
    alert('Berhasil');
    document.location = '../../public/items';
    </script>";
  } else {
    echo "
    <script>
    alert('Data tidak diubah');
    document.location = '../../public/items';
    </script>";
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
  <link rel="icon" href="../assets/img/logo.png">

</head>

<body>
  <!-- <div class="side">
    <?php require '../components/sidebar.php' ?>
  </div> -->

  <div class="container" style="margin-top: 100px;">
    <div class="row"">
      <div class=" col-xl-5 mb-3">
      <div class="card shadow">
        <div class="card-header">
          Tambah Paket
        </div>
        <div class="card-body">
          <form action="" method="post">
            <label for="outlet" class="form-label">Outlet :</label>
            <select name="outlet" class="form-select mb-3" id="outlet">
              <?php foreach ($paket as $selected) : ?>
                <option selected hidden value="<?= $selected['id_outlet'] ?>"><?= $selected['nama'] ?></option>
              <?php endforeach; ?>
              <?php foreach ($outlet as $item) : ?>
                <option value="<?= $item['id_outlet'] ?>"><?= $item['nama'] ?></option>
              <?php endforeach; ?>
            </select>
            <?php foreach ($paket as $value) : ?>
              <input type="hidden" name="idPaket" id="" value="<?= $value['id_paket'] ?>">
              <label for="jenis" class="form-label">Jenis :</label>
              <input type="text" class="form-control mb-3" value="<?= $value['jenis'] ?>" name="jenis" id="jenis">
              <label for="nmPaket" class="form-label">Nama Paket :</label>
              <input type="text" value="<?= $value['nama_paket'] ?>" class="form-control mb-3" name="nmPaket" id="nmPaket">
              <label for="harga" class="form-label">Harga :</label>
              <input type="number" class="form-control" value="<?= $value['harga'] ?>" name="harga" id="harga">
            <?php endforeach; ?>
        </div>
        <div class="card-footer text-muted">
          <button type="submit" class="btn btn-success float-end" name="uptPaket">Kirim</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-xl-7 mb-3">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="text-white text-center" style="background-color: #304362;">
            <tr>
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
                echo '<td colspan="5" class="text-center">data kosong</td>';
              } ?>
              <?php foreach ($paket as $items) : ?>
                <td><?= $items['nama'] ?></td>
                <td><?= $items['jenis'] ?></td>
                <td><?= $items['nama_paket'] ?></td>
                <td>Rp.<?= $items['harga'] ?></td>
                <td class="text-center">
                  <a href="editPaket?ip=<?= $items['id_paket'] ?>" class="badge btn text-dark"><i class="ri-edit-line"></i></a>
                  <a href="delPaket?iu=<?= $items['id_paket'] ?>" onclick="return confirm('Yakin untuk hapus?')" class="badge btn text-dark"><i class="ri-delete-bin-line"></i></a>
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